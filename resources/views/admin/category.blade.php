@extends('admin.adminlayout')

@section('content')



<div class="col-sm-9 mt-5">
    <!-- table -->
     <p class="bg-dark text-white p-2">
        List of Admins
     </p>
     <table class="table">
        <thead>
            <tr>
                <th scope="col">Sr. </th>
                <th scope="col">ID</th>
                <th scope="col">Category_Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $ct)
                
            <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $ct->id }}</td>
                <td>{{ $ct->Category_Name }}</td>
                <td>
                    <a  data-bs-toggle="modal" 
                        data-bs-target="#updCategoryModal{{ $ct->id }}"
                    class="btn btn-info mr-3">
                        <i class="fas fa-pen"></i>
                    </a>
                
                <form action="{{ route('category.destroy',$ct->id) }}" method="POST" class="d-inline"> 
                    @csrf
                    @method('DELETE')
                    <button
                    type="submit"
                    class="btn btn-secondary"
                    name="delete"
                    value="Delete"
                    onclick="return confirm('Are you sure you want to delete this Category?')">
                    <i class="far fa-trash-alt"></i>  
                    </button>
                </form>
                </td>
            </tr>



<!-- 🔵 Update Category Modal -->
<div class="modal fade" id="updCategoryModal{{ $ct->id }}" tabindex="-1" aria-labelledby="updCategoryLabel{{ $ct->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="updCategoryLabel{{ $ct->id }}">Update Category</h5>
        <button type="button" class="btn text-white" data-bs-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
      </div>

      <form id="updateCategoryForm{{ $ct->id }}">
        @csrf
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <input type="hidden" id="categoryUpdUrl{{ $ct->id }}" value="{{ route('category.update',$ct->id) }}">
        <input type="hidden" id="categoryIndexUrl" value="{{ route('category.index') }}">

        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="cat_id">Category id</label>
            <input type="text" class="form-control" value="{{ old('ct_id', $ct->id ) }}" name="ct_id" readonly>
            
            <label for="Category_Name">Category Name</label>
            <input type="text" 
              class="form-control" 
              id="Category_Name{{ $ct->id }}" 
              name="Category_Name" 
              value="{{ old('Category_Name', $ct->Category_Name ) }}">
          </div>
        </div>

        <div class="modal-footer">
            <div id="message{{ $ct->id }}"></div>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>



    @endforeach
</tbody>

</table>
<div class="mt-3 mb-3 d-flex justify-content-center">
    {{ $category->links() }}
</div>
</div>

<!-- Pagination -->







  <div> 
    <a
        class="btn btn-danger box"
        data-bs-toggle="modal" 
        data-bs-target="#addCategoryModal">
        <i class="fas fa-plus fa-2x"></i>
    </a>
</div>


<!-- 🔵 Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="addCategoryLabel">Add New Category</h5>
        <button type="button" class="btn text-white" data-bs-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
      </div>

      <form id="addCategoryForm">
        @csrf
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <input type="hidden" id="categoryStoreUrl" value="{{ route('category.store') }}">
        <input type="hidden" id="categoryIndexUrl" value="{{ route('category.index') }}">

        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="Category_Name">Category Name</label>
            <input type="text" 
                   class="form-control" 
                   name="Category_Name" 
                   placeholder="Enter Category Name">
          </div>
        </div>

        <div class="modal-footer">
            <div id="message"></div>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>









@endsection



<!-- 🟢 Alert placed before the main content starts -->
@section('alert')
    @if(session('success'))
        <div id="toastMessage" class="toast-message"> 
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function() {
                let toast = document.getElementById('toastMessage');
                if (toast) {
                    toast.classList.add('hide');
                }
            }, 4000);
        </script>

    @endif
@endsection




@section('scripts')
<!-- Custom Javascript -->
    <script src="{{ asset('js/new/custom.js') }}"></script>
@endsection
 
