@extends('user.Userlayout')

@section('content')

    <!-- Create Button -->
    <div class="text-start mt-2 ml-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#feedbackModal">
            Create Feedback
        </button>
    </div>

    <!-- Feedback Table -->
<!-- Feedback Table -->
<div class="col-sm-10 mt-2">
    <p class="bg-dark text-white p-2">List of User Feedback</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Feedback ID</th>
                <th>Description</th>
                <th class="col-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feedback as $fb)
            <tr>
                <td>{{ $fb->user_id }}</td>
                <td>{{ $fb->id }}</td>
                <td>{{ $fb->f_content }}</td>
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-info btn-sm p-3 mr-2 ml-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $fb->id }}">
                        <i class="fas fa-pen"></i>
                    </button>

                    <!-- Delete Form -->
                    <form action="{{ route('feedback.destroy', $fb->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm p-3">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>

            <!-- Edit Feedback Modal -->
            <div class="modal fade" id="editModal{{ $fb->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $fb->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header bg-secondary text-white">
                            <h5 class="modal-title" id="editModalLabel{{ $fb->id }}">Edit Feedback</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form method="POST" action="{{ route('feedback.update', $fb->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="feedback_description{{ $fb->id }}">Write Feedback
                                        <small class="text-muted">(Max 500 characters)</small>
                                    </label>

                                    <input type="hidden" name="userId" value="{{ $fb->user_id }}">
                                    <textarea class="form-control" rows="7"
                                        name="feedback_description"
                                        maxlength="500"
                                        id="feedback_description{{ $fb->id }}"
                                        placeholder="Enter your thoughts...">{{ old('feedback_description', $fb->f_content) }}</textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
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
</div>







{{-- Create feedback odel --}}

<div class="modal fade {{ $errors->any() ? 'show d-block' : '' }}" 
     id="feedbackModal" 
     tabindex="-1" 
     aria-labelledby="feedbackModalLabel" 
     aria-hidden="{{ $errors->any() ? 'false' : 'true' }}">
  <div class="modal-dialog modal-lg modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header bg-secondary text-white">
        <h5 class="modal-title" id="feedbackModalLabel">Submit Your Feedback</h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="post" action="{{ route('feedback.store') }}">
        @csrf
        <div class="modal-body">

          <input type="hidden" name="userId" value="{{ auth()->id() }}">

          <div class="form-group mb-3">
            <label for="feedback_description">Write Feedback 
              <small class="text-muted">(Max 500 characters)</small>
            </label>
            <textarea class="form-control" rows="7" 
              name="feedback_description" 
              maxlength="500"
              placeholder="Enter your thoughts...">{{ old('feedback_description') }}</textarea>

            @error('feedback_description')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>

      </form>
    </div>
  </div>
</div>

















{{-- Auto-open Modal if Validation Fails --}}


@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function(){
        var feedbackModal = new bootstrap.Modal(document.getElementById('feedbackModal'));
        feedbackModal.show();
    });
</script>
@endif






<!-- 🟢 Alert placed before the main content starts -->
{{-- @section('alert') --}}
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
            }, 2000);
        </script>
    @endif
{{-- @endsection --}}



{{-- JS to toggle form --}}


<script>
    $(document).ready(function () {
        $('#showFeedbackForm').click(function () {
            console.log('button clicked');
            $('#feedbackFormContainer').removeClass('d-none'); // form show
            $(this).closest('div').addClass('invisible'); // button hide
        });
    });
</script>


@endsection
