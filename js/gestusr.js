    function catchUserAjax(val1){
            var par = {
                'id' : val1,
                'type':'mostrar'
            };
            $.ajax({
                data: par,
                url: 'php/ajax_edit.php',
                type: 'post',
                datatype: 'html',
                success: function(data){
                    $('#data-modal').html(data);
                },
                error: function(xhr,status){
                    console.log(xhr.responseText);
                }
            });
            
        }

        function editUserAjax(val1,nombre,apellido,mail){
            var par = {
                'id' : val1,
                'type' : 'edit',
                'name' : nombre,
                'surname': apellido,
                'mail':mail
            };
            $.ajax({
                data: par,
                url: 'php/ajax_edit.php',
                type: 'post',
                datatype: 'html',
                success: function(data){

                },
                error: function(xhr,status){
                    console.log(xhr.responseText);
                }
            });
            
        }
        function backdefault(val1){
            var par = {
                'id' : val1,
                'type':'defpic'
            };
            $.ajax({
                data: par,
                url: 'php/ajax_edit.php',
                type: 'post',
                datatype: 'html',
                success: function(data){
                },
                error: function(xhr,status){
                    console.log(xhr.responseText);
                }
            });
            
        }


        function backpass(val1){
           var par = {
                'id' : val1,
                'type':'defpass'
            };
            $.ajax({
                data: par,
                url: 'php/ajax_edit.php',
                type: 'post',
                datatype: 'html',
                success: function(data){
                },
                error: function(xhr,status){
                    console.log(xhr.responseText);
                }
            });
            
        }

		$(".edituser").on("click",function(){
            var id=$(this).data("id");
            catchUserAjax(id);
            $('#myModal').modal('show'); 
		});
        $("#actualizar").on("click",function(){
            var id=$("#id-edit").val();
            var nombre=$(".input-name").val();
            var apellido=$(".input-surname").val();
            var mail=$(".input-mail").val();

            editUserAjax(id,nombre,apellido,mail);
            location.reload(true);
        });
        $("#defpic").on("click",function(){
            var id=$("#id-edit").val();
            backdefault(id);
            location.reload(true);
        });
        $("#defpass").on("click",function(){
            var id=$("#id-edit").val();

            backpass(id);
            location.reload(true);
        });