  @php
  $keywokrd = str_replace(' ', '+', $node->name);
  @endphp
  <div class="card">
    <img src="{{ asset($node->image) }}" alt="" class="avatar avatar-lg rounded-circle mx-auto">
      <h3>{{ $node->name }}</h3>
      <p>{{ $node->designation }}</p>
      <a href="{{ route('user.faculty_responsibility') }}?keywords={{ $keywokrd }}">Responsibilities</a>
      <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
          data-name="{{ $node->name }}" data-image="{{ asset($node->image) }}"
          data-designation="{{ $node->designation }}" data-email="{{ $node->email }}"
          data-phone="{{ $node->phone_pt_office }}" data-description="{{ $node->description }}">Bio Data</a>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Bio Data</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="p-3 d-flex flex-column gap-3">
                      <!-- User Image -->
                      <img src="" alt="" class="img-fluid avatar avatar-xl rounded-circle">
                      <!-- User Details -->
                      <div class="row">
                          <div class="col-lg-6">
                              <h3 class="name"></h3>
                          </div>
                          <div class="col-lg-6">
                              <span class="designation text-gray-800"></span>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-lg-6">
                              <div class="email"></div>
                          </div>
                          <div class="col-lg-6">
                              <div class="phone"></div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="description"></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('staticBackdrop');

    modal.addEventListener('show.bs.modal', function(event) {
        // Get the button that triggered the modal
        const button = event.relatedTarget;

        // Extract user data from data-* attributes
        const name = button.getAttribute('data-name');
        const image = button.getAttribute('data-image');
        const designation = button.getAttribute('data-designation');
        const email = button.getAttribute('data-email');
        const phone = button.getAttribute('data-phone');
        const description = button.getAttribute('data-description'); // Fetch description

        // Populate the modal fields
        modal.querySelector('img').src = image;
        modal.querySelector('img').alt = name;
        modal.querySelector('.name').textContent = name;
        modal.querySelector('.designation').textContent = designation;
        modal.querySelector('.email').textContent = `Email: ${email}`;
        modal.querySelector('.phone').textContent = `Phone: ${phone}`;
        modal.querySelector('.description').textContent = description; // Set description
    });
});
  </script>