

<script type="text/javascript">
    $(document).ready(function () {

        var counter = 0;
        var cond = [];
        function createBoxes() {
            var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
            newTextBoxDiv.after().html(
                    "<select id='field'" + ">" +
                    "<option>Select</option>" +
                    "<option value='first_name'>First Name</option>" +
                    "<option value='last_name'>Last Name</option>" +
                    "<option value='age'>Age</option>" +
                    "<option value='skills'>Skills</option>" +
                    "<option value='company_name'>Company</option>" +
                    "<option value='industry_segment'>Industry</option>" +
                    "<option value='email'>Email</option>" +
                    "<option value='country'>Country</option>" +
                    "</select>" +
                    "<select id='condition'>" +
                    "<option value='like'>Contains</option>" +
                    "<option value='='>Equals</option>" +
                    "<option value='<'>Less</option>" +
                    "<option value='>'>Bigger</option>" +
                    "</select>" +
                    "<input type='text' name='textbox'" + counter + " id='value'" + counter + '" value="" >');
            newTextBoxDiv.appendTo("#TextBoxesGroup");
            counter++;
        }

        function validateBoxes() {
            for (var i = 0; i < counter; i++) {
                var stringvalue = "TextBoxDiv" + i;
                var fieldVal = $('#' + stringvalue).children('select[id="field"]').val();
                var conditionVal = $('#' + stringvalue).children('select[id="condition"]').val();
                var valueVal = $('#' + stringvalue).children('input[id="value"]').val();
                if ((!isNaN(valueval))) {
                    alert("O fields")

                }

            }
        }
        $("#addButton").click(function () {

            if (counter > 10) {
                alert("Only 10 textboxes allow");
                return false;
            }
            createBoxes();
        });

        $("#removeButton").click(function () {
            if (counter == 0) {
                alert("No more textbox to remove");
                return false;
            }
            cond.pop();
            counter--;
            $("#TextBoxDiv" + counter).remove();

        });

        $("#sumbitButton").click(function () {
            $("#records_table tr:gt(0)").remove();
            for (var i = 0; i < counter; i++) {
                var stringvalue = "TextBoxDiv" + i;
                var fieldVal = $('#' + stringvalue).children('select[id="field"]').val();
                var conditionVal = $('#' + stringvalue).children('select[id="condition"]').val();
                var valueVal = $('#' + stringvalue).children('input[id="value"]').val();

                cond.push({
                    "field": fieldVal,
                    "condition": conditionVal,
                    "value": valueVal
                });
            }


            $.ajax({
                type: 'POST',
                url: 'SearchQuery.php',
                data: {'json': cond},
                contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                dataType: 'json',
                success: function (response) {
                   //alert(response);
                    var datajson = "[" + response + "]";
                     //alert(JSON.stringify(response));
                    var data = $.parseJSON(datajson);
                    var trHTML = '';
                    $.each(data, function (index, item) {
                        trHTML += '<tr><td>' +
                                item.first_name +
                                '</td><td>' +
                                item.last_name +
                                '</td><td>' +
                                item.country +
                                '</td><td style="visibility:collapse;">' +
                                item.id_user +
                                '</td></tr>';
                    });
                    $('#records_table').append(trHTML);
                    $("#records_table").css("visibility", "visible")

                },
                error: function () {
                    $("#records_table").css("visibility", "hidden")
                    alert("No results");
                }
            });

            cond = [];


        });
    });


    $(document).on("click", "#records_table tr", function (e) {
        var tableData = $(this).children("td").map(function () {
            return $(this).text();
        }).get();
        
        window.location = "home.php?op=view_advanced_search_details"+"&data="+$.trim(tableData[3]);
        

    });


</script>



<div id="container" class="col-md-6 col-md-offset-3">
    <h1>Advanced Search</h1>
    <div id='TextBoxesGroup'>
    </div>
    <br>
    <input type='button' class="btn btn-primary btn-sm" value='Add field' id='addButton'>
    <input type='button' class="btn btn-danger btn-sm" value='Remove field' id='removeButton'>
    <input type='submit' class="btn btn-success btn-sm" value='Submit' id='sumbitButton'>
    <form id="clickrowPost" action="details.php" method="POST">
        <table class="table" id="records_table" style="visibility:hidden;cursor: pointer">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Country</th>
                </tr>
            </thead>
            <tbody></tbody>
        
        </table>
    </form>
</div>

