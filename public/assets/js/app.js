
(function () {
    const menuToggle = document.querySelector('.menu-toggle')
    menuToggle.onclick = function (e) {
        const body = document.querySelector('body')
        body.classList.toggle('hide-sidebar')
    }
})()

$(function(){
    $('#type_material_id').change(function(){
        if( $(this).val() ) {
            $('#model_id').hide();
            $('.loading-model').show();
            $.ajax({
                type:'GET',
                url:'filterModelMaterial.php?filter='+$(this).val()+'&function='+$(this).name,
                dataType:'json',
                success:function(json) {
                    var options = '<option value="">Escolha o modelo</option>';	
                    for (var i = 0; i < json.length; i++) {
                        options += '<option value="' + json[i].id + '">' + json[i].name_model + '</option>';
                    }	
                    $('#model_id').html(options).show();
                    $('.loading-model').hide();
                }
            });
        } else {
            $('#model_id').html('<option value="">Escolha o modelo</option>');
        }
    });

    // $(window).on("load", function() {
    //     $('#fk_division_id').trigger("change");
    // });

    // $('#print-report').click(function(){
    //     var tableReport = document.getElementById("tableReport").innerHTML;
        
    // });

    $('#fk_division_id').change(function(){
        if( $(this).val() ) {
            $('#part_id').hide();
            $('.loading-part').show();
            $.ajax({
                type:'POST',
                url:'filterParts.php',
                data: 'filter='+($(this).val())+'&action=filterParts',
                dataType:'json',
                success:function(json) {
                    var options = '<option value="">Escolha o setor</option>';	
                    for (var i = 0; i < json.length; i++) {
                        options += '<option value="' + json[i].id + '">' + json[i].name_part + '</option>';
                    }	
                    $('#part_id').html(options).show();
                    $('.loading-part').hide();
                },
                error: function () {
                    $('#part_id').html('<option value="">Escolha o setor</option>');
                }
            });  
        } else {
            $('#part_id').html('<option value="">Escolha o setor</option>');
        }
    });

    // $('#subFilter').change(function(){
    //     if( $(this).val() ) {
    //         // $('#part_id').hide();
    //         // $('.loading-part').show();
    //         var subFilter = $(this).val();
    //         var name = $('#typeFilter').val();
    //         $.ajax({
    //             type:'POST',
    //             url:'ajax/subFilter.php',
    //             data: 'filter='+name+'&subFilter='+subFilter+'&action=sub-filter',
    //             dataType:'json',
    //             success:function(json) {
    //                 $('#bodyTableReport').empty();
    //                 for(var i=0; json.length>i;i++){
    //                     if(!json[i].count) {
    //                         $('#bodyTableReport').append(`
    //                         <tr>
    //                             <td>${json[i].number_unit}</td>
    //                             <td>${json[i].number_metallic ?? ''}</td>
    //                             <td>${json[i].number_bmp ?? ''}</td>
    //                             <td>${json[i].name_model}</td>
    //                             <td>${json[i].initials_division}</td>
    //                             <td>${json[i].name_part}</td>
    //                             <td>${json[i].name_status}</td>
    //                             <td>${json[i].name_condition}</td>
    //                             <td class="align-middle text-center">${json[i].amount}</td>
    //                         </tr>
    //                         `);
    //                         } else {
    //                             $('#bodyTableReport').append(`
    //                                 <tr>
    //                                     <td class="text-right font-weight-bold" colspan="8">Total</td>
    //                                     <td class="text-center font-weight-bold">${json[i].count}</td>
    //                                 </tr>
    //                             `);
    //                     }
    //                 };
    //                 var tableReport = document.getElementById("tableReport").innerHTML; 
    //                 $('#tableContent').val(tableReport);
    //             },
    //             error: function () {
    //                 $('#subFilter').html('<option value="">Escolher</option>');
    //             }
    //         });  
    //     } else {
    //         $('#subFilter').html('<option value="">Escolher</option>');
    //     }
    // });

    // $(function () {
        // function load(action) {
        //     var load_div = $(".ajax_load");
        //     if (action === "open") {
        //         var i = setInterval(function () {

        //             clearInterval(i);
        //             load_div.fadeIn().css("display", "block");
        //         }, 4000);
        //     } else {
        //         load_div.fadeOut();
        //     }
        // }
    // });

    // $("#form-subFilter").submit(function (e) {
    //     e.preventDefault();
        // var form = $(this);
        // var form_ajax = $(".form_ajax");
        // $.ajax({
        //     url: 'filterParts.php',
        //     data: form.serialize(),
        //     type: "POST",
        //     dataType: "json",
        //     beforeSend: function () {
        //         $('#loading').fadeIn().css("display", "block");
        //     },
        //     success: function (callback) {
        //         console.log(callback);
        //     },
        //     complete: function () {
        //         $('#loading').hide();
        //     }
        // });
    // });
});

    // $('#form').bind('submit', function(e){
    //     e.preventDefault();

    //     var txt = $(this).serialize();
    //     console.log(txt);

    //     $.ajax({
    //         type:'GET',
    //         url:'filterModelMaterial.php?filter=2',
    //         data:txt,
    //         success:function(resultado) {
    //             $('#teste').html("Resultado: "+resultado);
    //         },
    //         error:function(){
    //             alert("Ocorreu um erro!");
    //         }
    //     });
    // });