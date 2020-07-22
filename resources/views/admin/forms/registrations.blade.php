<div class="form-group">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(isset($registrations))
        <div class="form-group" display="none">
            <input class="hidden" name="id" id="id" value="{{ $registrations->id }}">
        </div>
    @endif
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Email:</label>
        </div>
        <div class="col-md-10">
            @if(isset($registrations)) <input type="text" name="email" id = "email" class="form-control" placeholder="email" value="{{ $registrations->email }}" required />
            @else <input type="text" name="email" id ="email" class="form-control form-validate" placeholder="email" required />
            @endif
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">IP:</label>
        </div>
        <div class="col-md-10">
            @if(isset($registrations)) <input type="text" name="ip" id = "ip" class="form-control" placeholder="ip" value="{{ $registrations->ip }}" required />
            @else <input type="text" name="ip" id ="ip" class="form-control form-validate" placeholder="ip" required />
            @endif
        </div>
    </div>
    <div class = "form-group">
        <div class="col-md-2">
            <label class="control-label">Vreme:</label>
        </div>
        <div class="col-md-10">
            @if(isset($registrations)) <input type="datetime-local" name="created_at" id = "created_at" class="form-control" placeholder="created_at" value="{{ $registrations->created_at }}" />
            @else <input type="datetime-local" name="created_at" id ="created_at" class="form-control form-validate" placeholder="created_at" />
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="form-footer col-lg-offset-1 col-md-offset-1 col-sm-9">
            <button type="button" class="btn btn-primary" id="addBuilding" data-toggle="modal" data-target="#simpleModal">{{$submit}} Prijavu</button>
        </div>
    </div>
    <!-- START SIMPLE MODAL MARKUP -->
    <div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="simpleModalLabel">Sačuvajte promene</h4>
                </div>
                <div class="modal-body">
                    <p><text>Da li želite da </text> @if ($submit == 'Dodaj')<text>dodate</text>
                        @elseif ($submit == 'Uredi')<text>uredite</text>
                        @endif <text> Prijavu?</text>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ne</button>
                    <button type="submit" id="submitBuilding" class="btn btn-primary">Sačuvaj</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- END SIMPLE MODAL MARKUP -->
</div>
