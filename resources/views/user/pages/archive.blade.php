@include('user.includes.header')
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Archives</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="contsearch" style="min-height:320px;">
                <form id="form2" name="form2" action="javascript:void(0);" onsubmit="return redirectToCategory();">
                    <fieldset>
                        <label class="txt">Search :</label>
                        <label for="category">
                            <select name="cattype" id="cattype" fdprocessedid="247li8">
                                <option value="">Select Category</option>
                                <option value="1">News</option>
                                <option value="2">Tenders</option>
                                <option value="3">Vacancy</option>
                                <option value="4">Latest Updates</option>
                                <option value="5">Orders and circulars</option>
                            </select>
                        </label>

                        <label for="btn2">
                            <input id="btn2" type="submit" value="Submit" class="btn" fdprocessedid="a5chyc">
                            <input type="hidden" name="action" value="submit">
                        </label>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</section>
@include('user.includes.footer')

<script>
    function redirectToCategory() {
        const category = document.getElementById('cattype').value;
        let url = '';
        switch (category) {
            case '1': // News
                url = '{{ route("user.news_old_listing") }}';
                break;
            case '2': // Tenders
                url = '{{ route("user.tenders_archive") }}';
                break;
            case '3': // Vacancy
                url = '{{ route("user.vacancy") }}';
                break;
            default:
                // alert('Please select a valid category.');
                return false;
        }
        if (url) {
            window.location.href = url;
        }
        return false;
    }
</script>
    