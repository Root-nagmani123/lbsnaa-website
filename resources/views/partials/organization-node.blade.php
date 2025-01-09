                  <div class="card">
                      @php
                      $keyword = str_replace(' ', '+', $node->name);
                      @endphp
                      <div class="p-3">
                          <img src="{{ asset($node->image) }}" alt="mentor 5" class="avatar avatar-lg rounded-circle">
                          <!--content-->
                          <div class="mt-3">
                              <h3 class="mb-0 h4">{{ $node->name }}</h3>
                              <span class="text-gray-800">{{ $node->designation }}</span>
                          </div>
                      </div>
                      <a href="{{ route('user.faculty_responsibility') }}?keywords={{ $keyword }}">Responsibility</a>
                      <a href="#" data-bs-toggle="modal" data-bs-target="#bioDataModal" data-name="{{ $node->name }}"
   data-image="{{ asset($node->image) }}" data-designation="{{ $node->designation }}"
   data-email="{{ $node->email }}" data-phone="{{ $node->phone_pt_office }}"
   data-description-id="description-{{ $node->id }}">
    Bio Data
</a>
<input type="hidden" id="description-{{ $node->id }}" name="description" value="{{ htmlspecialchars($node->description, ENT_QUOTES, 'UTF-8') }}" />

                  </div>

                  <!-- Modal Structure -->
                  <div class="modal fade" id="bioDataModal" tabindex="-1" aria-labelledby="bioDataModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="bioDataModalLabel">Bio Data</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                      aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <div class="row">
                                      <div class="col-lg-3 ">
                                          <img id="modalImage" src="" alt="Image"
                                              class="img-fluid rounded-4" style="height:150px;width:150px;">
                                      </div>
                                      <div class="col-lg-3">
                                        <h3>Name:-</h3>
                                        <p>Designation:-</p>
                                        <p>Email:-</p>
                                        <p>Phone:-</p>
                                      </div>
                                      <div class="col-lg-6">
                                          <h3 id="modalName"></h3>
                                          <p id="modalDesignation"></p>
                                          <p id="modalEmail"></p>
                                          <p id="modalPhone"></p>
                                      </div>
                                      <div class="col-lg-12 mt-3">
                                      <p id="modalDescription"></p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <script>
document.addEventListener('DOMContentLoaded', () => {
    const bioDataModal = document.getElementById('bioDataModal');

    bioDataModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Button that triggered the modal

        // Extract info from data-* attributes
        const name = button.getAttribute('data-name');
        const image = button.getAttribute('data-image');
        const designation = button.getAttribute('data-designation');
        const email = button.getAttribute('data-email');
        const phone = button.getAttribute('data-phone');
        const descriptionId = button.getAttribute('data-description-id');

// Fetch the hidden input value using the descriptionId
const description = document.getElementById(descriptionId).value;

// Decode HTML entities
const textarea = document.createElement('textarea');
textarea.innerHTML = description;
const decodedDescription = textarea.value;
console.log(decodedDescription);
        // Update the modal's content
        bioDataModal.querySelector('#modalImage').src = image;
        bioDataModal.querySelector('#modalName').textContent = name;
        bioDataModal.querySelector('#modalDesignation').textContent = designation;
        bioDataModal.querySelector('#modalEmail').textContent = email;
        bioDataModal.querySelector('#modalPhone').textContent = phone;

        // Decode HTML entities for description and render as HTML
        bioDataModal.querySelector('#modalDescription').innerHTML = decodedDescription;
    });
});
                  </script>