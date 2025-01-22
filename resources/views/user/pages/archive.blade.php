@include('user.includes.header')
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" style="color: #af2910;">@if(Cookie::get('language') == '2')
                                घर
                                @else
                                Home
                                @endif</a>
                        </li>
                        <li class="breadcrumb-item active">
                                @if(Cookie::get('language') == '2')
                                अभिलेखागार
                                @else
                                Archives
                                @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-2">
    <div class="container-fluid">
        <div class="row">
            <div class="contsearch" style="min-height:320px;">
                <form id="form2" name="form2" action="javascript:void(0);" onsubmit="return redirectToCategory();">
                    <fieldset>
                        <label class="txt">
                            @if(Cookie::get('language') == '2')
                            खोज :
                            @else
                            Search :
                            @endif
                        </label>
                        <label for="category">
                            <select name="cattype" id="cattype" fdprocessedid="247li8" class="form-control">
                                <option value="">
                                    @if(Cookie::get('language') == '2')
                                    श्रेणी चुनना
                                    @else
                                    Select Category
                                    @endif
                                </option>
                                <option value="1">
                                    @if(Cookie::get('language') == '2')
                                    समाचार
                                    @else
                                    News
                                    @endif
                                </option>
                                <option value="2">
                                    @if(Cookie::get('language') == '2')
                                    निविदाओं
                                    @else
                                    Tenders
                                    @endif
                                </option>
                                <option value="4">
                                    @if(Cookie::get('language') == '2')
                                    नवीनतम अपडेट
                                    @else
                                    Latest Updates
                                    @endif
                                </option>
                                <option value="5">
                                    @if(Cookie::get('language') == '2')
                                    आदेश और परिपत्र
                                    @else
                                    Orders and circulars
                                    @endif
                                </option>
                            </select>
                        </label>

                        <label for="btn2">
                            <input id="btn2" type="submit" class="btn btn-primary" fdprocessedid="a5chyc" >
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