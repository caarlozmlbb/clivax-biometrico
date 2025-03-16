<form id="guardar_horas_form" method="post" accept-charset="utf-8">
    @csrf
    <fieldset style="padding-top:0px;margin-top:0px;">
        <legend>NUEVO REGISTRO:::.. {{Session::get('ambiente')}}</legend>

        <div class="row">

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group1 ">
                    <label class="fg-cobalt">.::: DIAS :::.</label>
                    <select name="id_horario" id="id_horario" class="form-control" required>
                        @foreach($horario as $h)
                        <option value="{{$h->id_horario}}">{{$h->dias}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group1 ">
                    <label class="fg-cobalt">.::: HORA INICIO DE MARCADO :::.</label>
                    <input type="time" name="inicio" id="inicio" class="form-control" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group1 ">
                    <label class="fg-cobalt">.::: HORA FIN DE MARCADO :::.</label>
                    <input type="time" name="fin" id="fin" class="form-control" required>
                </div>
            </div>
        </div>

    </fieldset>

    <fieldset>
        <div class="modal-footer">
            <button type="submit" id="botone" class="btn btn-primary btn-rounded btn-outline ">GENERAR</button>
            <button type="button" class="btn btn-primary btn-rounded btn-outline " data-dismiss="modal">CANCELAR</button>
        </div>
    </fieldset>

</form>

<script>
    $("#guardar_horas_form").submit(function(event) {
        event.preventDefault();
        //document.getElementById('boton').disabled = true;
        $.ajax({
            url: "/guardar_horas",
            type: 'POST',
            data: $("#guardar_horas_form").serialize(),
            success: function() {
                swal("NOTA!", "EXITOSAMENTE GUARDADO", "success");
                setTimeout(function() {
                    window.location = '';
                }, 1000);
            }
        });
    });
</script>
