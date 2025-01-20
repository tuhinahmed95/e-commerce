@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{ route('checked.restore') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3>Category Trash List</h3>
                </div>
                <div class="card-body">
                    @if (session('restore'))
                        <div class="alert alert-success">{{ session('restore') }}</div>
                    @endif

                    @if(session('permanentDelete'))
                    <div class="alert alert-danger">{{ session('permanentDelete') }}</div>

                    @else

                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" id="chkSelectAll" class="form-check-input">
                                        Check All
                                        <i class="input-frame"></i>
                                    </label>
                                </div>
                            </th>
                            <th>Sl</th>
                            <th>Category Name</th>
                            <th>Category Icon</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($categories as $key=> $categorie)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="category_id[]" class="form-check-input chkDel" value="{{ $categorie->id }}">
                                      <i class="input-frame"></i>
                                    </label>
                                </div>
                            </td>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $categorie->category_name }}</td>
                            <td>
                                <img src="{{ asset('uploads/category') }}/{{ $categorie->icon }}" alt="">
                            </td>
                            <td>
                                <a title="Restore" href="{{ route('category.restore',$categorie->id) }}" class="btn btn-success btn-icon"><i data-feather="rotate-cw"></i>
                                </a>

                                <a title="Restore" href="{{ route('category.permanent.delete',$categorie->id) }}" class="btn btn-danger btn-icon"><i data-feather="trash"></i>
                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="4"><h4 class="text-center text-info">No Trash Category Found</h4></td>
                        </tr>

                        @endforelse
                    </table>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-success">Restore Check</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('footer_script')
<script>
    $("#chkSelectAll").on('click', function(){
        this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false);
    })
</script>
@endsection
