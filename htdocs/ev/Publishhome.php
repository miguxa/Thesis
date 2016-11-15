<script type="text/javascript">
    $(document).ready(function () {

        var counter = 0;
        var cond = [];
        function createBoxes() {
            var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
            newTextBoxDiv.after().html(
                    "<select id='field'" + ">" +
                    "<option>Select</option>" +
                    "<option value='job_title'>Job title</option>" +
                    "<option value='start_date'>Start Date</option>" +
                    "<option value='location'>Location</option>" +
                    "<option value='job_length'>Job Lenght</option>" +
                    "<option value='budget'>Budget</option>" +
                    "<option value='description'>Description</option>" +
                    "<option value='keywords'>Keywords</option>" +
                    "<option value='budgetMinRange'>Budget minimum</option>" +
                    "<option value='budgetMaxRange'>Budget maximum</option>" +
                    "<option value='partTime'>Part time</option>" +
                    "<option value='periodType'>Period Type</option>" +
                    "<option value='lengthJobType'>Job Type Lenght</option>" +
                    "<option value='descriptionLanguage'>Language description</option>" +
                    "<option value='reqSkills'>Skills</option>" +
                    "<option value='LanguagesSpoken'>Language</option>" +
                    "</select>" +
                    "<select id='condition'>" +
                    "<option value='<'>Less</option>" +
                    "<option value='='>Equal</option>" +
                    "<option value='>'>More</option>" +
                    "<option value='like'>Contains</option>" +
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
                url: 'PublishSearchQuery.php',
                data: {'json': cond},
                contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                dataType: 'json',
                success: function (response) {
                  //alert(response);
                    var datajson = "[" + response + "]";
                    var data = $.parseJSON(datajson);
                    var trHTML = '';
                    $.each(data, function (index, item) {
                        trHTML += '<tr><td>' +
                                item.job_title +
                                '</td><td>' +
                                item.location +
                                '</td><td>' +
                                item.start_date +
                                '</td><td>' +
                                item.job_length +
                                '</td><td style="visibility:collapse;">' +
                                item.id_work +
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
        window.location = "home.php?op=view_publish_details&idwork=" + $.trim(tableData[4]);
    });

  
</script>


<div id="container" class="col-md-6 col-md-offset-3">
    <h1>Advanced Seach</h1>
    <div id='TextBoxesGroup'>
    </div>
    <br>
    <input type='button' class="btn btn-primary btn-sm" value='Add field' id='addButton'>
    <input type='button' class="btn btn-danger btn-sm" value='Remove field' id='removeButton'>
    <input type='submit' class="btn btn-success btn-sm" value='Submit' id='sumbitButton'>
  
        <table class="table" id="records_table" style="visibility:hidden">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Start Date</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
 
</div>
