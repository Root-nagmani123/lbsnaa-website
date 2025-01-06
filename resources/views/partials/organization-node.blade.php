 <div class="card rounded-4 card-bordered card-lift" style="width: 18rem;">
     <div class="p-3 d-flex flex-column gap-3">
         <!--img-->
         <a href="#">
             <img src="{{ asset($node->image) }}" alt="{{ $node->name }}" class="img-fluid rounded-4"
                 style="height:150px; object-fit:cover;width:100%;">
         </a>
         <!--content-->
         @php
         $keywokrd = str_replace(' ', '+', $node->name);
         @endphp
         <div class="d-flex flex-column gap-4">
             <div class="d-flex flex-column gap-2">
                 <div>
                     <div class="d-flex align-items-center gap-2">
                         <h3 class="mb-0">{{ $node->name }}</h3>
                     </div>
                     <span class="text-gray-800">{{ $node->designation }}</span>
                 </div>
             </div>
             <div class="d-flex align-items-center justify-content-between fs-6">
                 <div>
                     <span>Email: <?= $node->email;?></span>
                 </div>
                 <div class="d-flex gap-1 align-items-center lh-1">
                     <span><?= $node->phone_pt_office;?></span>
                 </div>
             </div>
         </div>
         <div class="d-flex flex-row justify-content-between align-items-center gap-3">
             <div>
                 <a href="{{ route('user.faculty_responsibility') }}?keywords={{ $keywokrd }}"
                     class="btn btn-outline-primary">Responsibilities</a>
             </div>
             <div>
                 <!-- Trigger Button for Modal -->
                 <!-- Trigger Button -->
                 <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                     data-bs-target="#staticBackdrop" data-name="{{ $node->name }}"
                     data-image="{{ asset($node->image) }}" data-designation="{{ $node->designation }}"
                     data-email="{{ $node->email }}" data-phone="{{ $node->phone_pt_office }}"
                     data-description="{{ $node->description }}">
                     Bio Data
                 </button>


             </div>
         </div>
     </div>
 </div>
 @if (!empty($node->children))
 <div class="branch child-container ">
     @foreach ($node->children as $child)
     @include('partials.organization-node', ['node' => $child])
     @endforeach
 </div>
 @endif

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
                     <img src="" alt="" class="img-fluid rounded-4" style="height:350px; object-fit:cover;width:100%;">
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


 <style>
/* Add spacing between child cards */
.child-container {
    display: flex;
    /* Ensures the child cards are laid out in a row */
    flex-wrap: wrap;
    /* Allows cards to wrap to the next row on small screens */
    gap: 20px;
    /* Space between the cards */
    justify-content: center;
    /* Centers the child cards */
}

.card {
    margin: 10px;
    /* Additional margin for fine-tuning */
}
 </style>
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
