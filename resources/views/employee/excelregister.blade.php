<form id="excelImportForm" action="{{ route('employees.excelimport') }}" method="POST" class="bg-white my-5 border p-3 rounded" enctype="multipart/form-data">
    @csrf
    <div class="d-flex justify-content-end">
        <a href="{{ route('employees.excelexport') }}" class="btn btn-success px-4 py-2 rounded-pill d-flex align-items-center gap-2"><i class="bi bi-file-earmark-spreadsheet"></i>  <span>Excel Format Download</span></a>
    </div>
    <div class="d-flex justify-content-center align-items-center my-5"  dropzone="excelInput">
        <div class="border p-5 w-50 rounded border text-center bg-body-tertiary" style="cursor:pointer" id="excelDrop">
            <div style="transform: rotate(20deg)">
                <i class="bi bi-paperclip fs-3 text-muted " ></i>
            </div>
            <p class="mt-2">Browse your excel file</p>
        </div>
    </div>
    <p id="fileName" style="margin-left:320px"></p>
    <input type="file" id="excelInput" class=" d-none" name="excel">
    <div class="d-flex justify-content-center my-3">
        <button form="excelImportForm" class=" btn btn-primary px-5 py-2" type="submit">Save</button>
    </div>
</form>
