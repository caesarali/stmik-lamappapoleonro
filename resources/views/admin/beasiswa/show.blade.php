<form class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Sumber :</label>
        <div class="col-sm-10">
            <p class="form-control-static">{{ $beasiswa->sumber }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Syarat :</label>
        <div class="col-sm-10">
            {!! $beasiswa->syarat !!}
        </div>
    </div>
</form>