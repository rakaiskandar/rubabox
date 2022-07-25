@include ('template.main1')

<title>{{ $title }}</title>
<body class="dashboard">
    <div class="wrapper">

        <!-- Sidebar -->
        @include ('layout.sidebar')

        <div class="dashboard-content">
            <div class="row justify-content-between">
                <div class="col-4 title-dashboard">Upload File</div>
                <div class="col-md-3 title-user justify-content-center">{{ auth()->user()->username }}</div>
            </div>
            <div class="line"></div>

            <div class="content-header">
                <div class="col-4 title-uf">Edit File</div>
            </div>

            <div class="form-edit">
                <form action="{{ url('/edit/file') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2 col-md-12">
                        <label for="" class="form-label">File Code</label>
                        <input type="text" class="form-control" name="file_code" id="" aria-describedby="helpId" placeholder="Type your file code..." value="{{ $files[0]->file_code }}" readonly>
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">File Name</label>
                      <input type="text" class="form-control" name="file_name" id="" aria-describedby="helpId" placeholder="" value="{{ $files[0]->file_name }}" required>
                    </div>
                    <div class="mb-2 col-md-12">
                        <label for="" class="form-label">Subsi Code</label>
                        <select name="subsi_code" class="form-select" aria-label="Default select example" required>
                            <option value="">Choose Subsi Code</option>
                            <option value="SBS-1" {{ $files[0]->subsi_code == 'SBS-1' ? 'selected' : ''}} >SBS-1 - Adpel</option>
                            <option value="SBS-2" {{ $files[0]->subsi_code == 'SBS-2' ? 'selected' : ''}}>SBS-2 - Pamlola</option>
                            <option value="SBS-3" {{ $files[0]->subsi_code == 'SBS-3' ? 'selected' : ''}}>SBS-3 - Tata Usaha</option>
                            <option value="SBS-4" {{ $files[0]->subsi_code == 'SBS-4' ? 'selected' : ''}}>SBS-4 - Humas</option>
                        </select>
                    </div>
                    <div class="mb-2 col-md-12">
                        <label for="" class="form-label">Section</label>
                        <input type="text" class="form-control" name="section" id="" aria-describedby="helpId" placeholder="Type your section..." value="{{ $files[0]->section }}" required>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="" class="form-label">Upload File</label>
                        <input class="form-control mb-3" type="file" id="formFile" name="file" accept=".jpg,.jpeg,.png,.doc,.docx,.xlsx,.xls,.pdf" required>
                        
                        @if ($files[0]->type == "jpg" || $files[0]->type == "jpeg" || $files[0]->type == "png")
                            <img src="{{ asset('file')}}/{{$files[0]->file}}" class="card border-secondary" alt="" style="width: 300px;height:300px;">
                        @elseif($files[0]->type == "docx" || $files[0]->type == "doc")
                            <a href="{{ asset('file')}}/{{$files[0]->file}}">
                                <img src="{{ asset('asset/img/logo/logo_docs.svg')}}" class="card border-secondary" alt="" style="width: 300px;height:300px;"></img>
                            </a>
                        @elseif($files[0]->type == "xlsx" || $files[0]->type == "xls")
                            <a href="{{ asset('file')}}/{{$files[0]->file}}">
                                <img src="{{ asset('asset/img/logo/logo_excel.svg')}}" class="card border-secondary" alt="" style="width: 300px;height:300px;"></img>
                            </a>
                        @elseif($files[0]->type == "pdf")
                            <a href="{{ asset('file')}}/{{$files[0]->file}}">
                                <img src="{{ asset('asset/img/logo/logo_pdf.svg')}}" class="card border-secondary" alt="" style="width: 300px;height:300px;"></img>
                            </a>
                        @else
                            <a href="{{ asset('file')}}/{{$files[0]->file}}">{{$files[0]->file_name}}</a>
                        @endif

                    </div>
                    <div class="d-flex mb-3">
                        <a href="/dashboard/upload" class="btn btn-danger ms-auto">Back</a>
                        <button type="submit" class="btn btn-warning ms-2">Edit File</button>
                    </div>
                    <br>
                </form>
            </div>

        </div>
    </div>
    @include ('template.main2')
</body>