                  <div class="card card-lift" style="width: 18rem;">
                      @php
                      $keyword = str_replace(' ', '+', $node->name);
                      @endphp
                      <div class="card-body" style="padding:0;">
                          <img src="{{ asset($node->image) }}" alt="{{ $node->name }}" class="avatar avatar-xl rounded-circle">
                          <!--content-->
                          <div class="m-2">
                          <h3 class="mb-0 h4">
                                    @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                        
                                        {{ $node->name_in_hindi }}
                                    @else
                                    {{ $node->name }}
                                    @endif
                                </h3>
                             
                              <h4 class="text-gray-800 h5">
                              @if(isset($_COOKIE['language']) && $_COOKIE['language'] == '2')
                                        
                                        {{ $node->designation_in_hindi }}
                                    @else
                                    {{ $node->designation }}
                                    @endif
                              </span>
                          </div>
                      </div>
                      <div class="card-footer" style="border:0;background-color:transparent;padding:0;">
                      <a href="{{ route('user.faculty_responsibility') }}?keywords={{ $keyword }}">
                        {{ $_COOKIE['language'] == '2' && !empty($node->name_in_hindi) ? $node->name_in_hindi : $node->name }} 
                        {{ $_COOKIE['language'] == '2' ? 'ज़िम्मेदारी' : 'Responsibility' }}
                    </a>


                    <a href="#" data-bs-toggle="modal" data-bs-target="#bioDataModal"
   data-name="{{ $_COOKIE['language'] == '2' && !empty($node->name_in_hindi) ? $node->name_in_hindi : $node->name }}"
   data-image="{{ asset($node->image) }}"
   data-designation="{{ $_COOKIE['language'] == '2' && !empty($node->designation_in_hindi) ? $node->designation_in_hindi : $node->designation }}"
   data-email="{{ $node->email }}"
   data-phone="{{ $node->phone_pt_office }}"
   data-description-id="description-{{ $node->id }}">
   {{ $_COOKIE['language'] == '2' && !empty($node->name_in_hindi) ? $node->name_in_hindi : $node->name }} 
   {{ $_COOKIE['language'] == '2' ? 'बायोडेटा' : 'Bio Data' }}
</a>


<input type="hidden" id="description-{{ $node->id }}" name="description"
       value="{{ htmlspecialchars($_COOKIE['language'] == '2' && !empty($node->description_in_hindi) ? $node->description_in_hindi : $node->description, ENT_QUOTES, 'UTF-8') }}" />

                      </div>
                  </div>

                  <!-- Modal Structure -->
                  <div class="modal fade" id="bioDataModal" tabindex="-1" aria-labelledby="bioDataModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="bioDataModalLabel">{{ $_COOKIE['language'] == '2' ? 'बायोडेटा' : 'Bio Data' }}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                      aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <div class="row">
                                      <div class="col-lg-3 ">
                                          <img id="modalImage" src="" alt="Image" class="img-fluid rounded-4"
                                              style="height:150px;width:150px;">
                                      </div>
                                      <div class="col-lg-3">
                                      <h6>{{ $_COOKIE['language'] == '2' ? 'नाम' : 'Name' }}:-</h6>
                                        <p>{{ $_COOKIE['language'] == '2' ? 'पद' : 'Designation' }}:-</p>
                                        <p>{{ $_COOKIE['language'] == '2' ? 'ईमेल' : 'Email' }}:-</p>
                                        <p>{{ $_COOKIE['language'] == '2' ? 'फ़ोन' : 'Phone' }}:-</p>

                                      </div>
                                      <div class="col-lg-6">
                                          <h6 id="modalName"></h6>
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