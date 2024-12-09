@include('user.includes.header')



<!-- Page Content -->
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Faculty</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 content-area">
            <h2 class="heading">Inhouse Faculty</h2>
            <p></p>

            <div class="contsearch">
                <form id="form2" action="{{ url()->current() }}" method="GET">
                    <fieldset>
                        <label class="txt">Search by Keywords:</label>
                        <label for="keywords">
                            <input type="text" id="Keywords" name="keywords" value="{{ request('keywords') }}"
                                placeholder="Search Faculty" fdprocessedid="79mcc">
                        </label>

                        <label for="btn2">
                            <input id="btn2" type="submit" value="Submit" class="btn" fdprocessedid="6rx09">
                            <input type="hidden" name="action" value="submit">
                        </label>
                    </fieldset>
                </form>
            </div>

            <table width="100%" border="0" cellspacing="0" align="center" cellpadding="4" class="dataTable">
                <thead>
                    <tr class="even">
                        <th width="5%">Serial</th>
                        <th width="20%">Name</th>
                        <th width="20%">Designation</th>
                        <th width="20%">Email</th>
                        <th width="15%">Office</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($faculty) > 0)
                    @foreach($faculty as $key => $value)
                    <tr>
                        <td style="padding-left:10px;">{{ $loop->iteration }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->designation }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->mobile }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">No records found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>


    </div>
</section>





@include('user.includes.footer')