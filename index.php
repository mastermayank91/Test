    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> test </title>

        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="bootstrap.min.css">
        <!--
            -------------
            | jquery js |
            -------------
        -->
        <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
        <script src="./jquery.min.js"></script>

    </head>

    <body>

        <!-- container -->
        <div class="container">
            <div class="row">

                <!-- <a href="#hello" id='like'> like</a> -->

                <!-- ( update form )  -->
                <div class="w-100">

                    <form class="row align-items-center" id="updateForm">

                        <div class="col-3">
                            <input type="text" class="form-control" id="update_id" placeholder="Id"/>
                        </div>

                        <div class="col-3">
                            <input type="text" class="form-control" id="update_first_name">
                        </div>

                        <div class="col-3">
                            <input type="text" class="form-control" id="update_last_name">
                        </div>

                        <div class="col">
                            <input class="form-check-input update_gender" type="radio" value="F" name="updategender" id="updategender1">
                            <label class="form-check-label" for="updategender1"> Female </label>
                        </div>
                        <div class="col">
                            <input class="form-check-input update_gender" type="radio" value="M" name="updategender" id="updategender2">
                            <label class="form-check-label" for="updategender2"> Male </label>
                        </div>
                        <div class="col">

                            <input class="form-check-input update_gender" type="radio" value="T" name="updategender" id="updategender3">
                            <label class="form-check-label" for="updategender3"> TransGender </label>
                        </div>

                        <div class="col">
                            <input type="submit" value="updateata" class="btn btn-dark btn-sm w-100" id="updateButton">
                        </div>

                    </form>

                </div>
                
                <div class="col-12">

                    <div class="h1 text-warning my-5"> 1 ... </div>

                    <div class="w-100" id="alertBox"></div>

                </div>
                <!-- ( insert form ) -->
                <div class="col-12 p-2 border border-warning">

                    <form class="row align-items-center" id="insertForm">

                        <div class="col-1">
                            <input type="text" class="form-control" id="id" placeholder="Id"/>
                        </div>
                        
                        <div class="col-2">
                            <input type="text" class="form-control" id="first_name">
                        </div>
                        
                        <div class="col-2">
                            <input type="text" class="form-control" id="last_name">
                        </div>

                        <div class="col">
                            <input class="form-check-input gender" type="radio" value="F" name="gender" id="gender1">
                            <label class="form-check-label" for="gender1"> Female </label>
                        </div>
                        <div class="col">
                            <input class="form-check-input gender" type="radio" value="M" name="gender" id="gender2" />
                            <label class="form-check-label" for="gender2"> Male </label>
                        </div>
                        <div class="col">

                            <input class="form-check-input gender" type="radio" value="T" name="gender" id="gender3" />
                            <label class="form-check-label" for="gender3"> TransGender </label>
                        </div>
                        
                        <div class="col">
                            <input type="submit" value="insert data" class="btn btn-dark btn-sm w-100" id="insertButton" />
                        </div>
                        
                    </form>
                    
                </div>
                
                <div class="col-12">

                    <div id="output_result"></div>

                </div>
            
            </div>
        </div>

        <!--
            ----------
            | script |
            ----------
        -->
    
        <script>

            $(document).ready(function () {

                /* messageBox function alert message display */

                function messageBox(status, text)
                {
                    if (status)
                    {
                        $("#alertBox").addClass('alert alert-success').text(text).fadeIn()
                    }
                    else
                    {
                        $("#alertBox").addClass('alert alert-danger').text(text).fadeIn()
                    }
                    setTimeout(() => {
                    
                        $("#alertBox").fadeOut("slow")
                    
                    }, 4000)
                }

                /* loadData function fetch load all data php file */

                function loadData() 
                {
                    $.ajax({
                        url : 'loadAllData.php',
                        type : 'GET',
                        beforeSend : () => {
                            
                            $("#output_result").html(`
                                <div class="spinner-border" role="status" id='loader'>
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            `)
                        },
                        success : (response) => {

                            $("#output_result").append(`
                                <div class='row'>
                                    <div class='col-2 text-light bg-dark'> Id </div>
                                    <div class='col text-light bg-dark'> Name </div>
                                    <div class='col-2 text-light bg-dark'> Gender </div>
                                    <div class='col-2 text-light bg-dark text-end'> Option </div>
                                </div>
                            `)

                            let return_data = JSON.parse(response)

                            // console.log(return_data.message)

                            if (return_data.status) 
                            {
                                let data = return_data.data

                                for (let i = 0; i < data.length; i++)
                                {
                                    let id = data[i]['id']
                                    $("#output_result").append(`
                                        <div class='row d-flex align-items-center border border-warning'>
                                            <div class='col-2 p-1'> ${id} </div>
                                            <div class='col p-1'> ${data[i]['fname']} ${data[i]['lname']} </div>
                                            <div class='col-2 p-1'> ${(data[i]['gender'] == 'F')? "Female":(data[i]['gender'] == 'M')? "Male" : "Transgender"} </div>
                                            <div class='col-2 d-flex justify-content-between'>
                                                <button class='btn btn-success btn-sm py-1 editButton' value='${id}'> edit </button>
                                                <button class='btn btn-danger btn-sm py-1 deleteButton' value='${id}'> delete </button>
                                            </div>
                                        </div>
                                    `)
                                }
                            }
                            else
                            {   
                                messageBox(0, `warning ${return_data.message}`)
                            }
                        },
                        error : (error) => {

                            messageBox(0, `ajax fetch failed : ${error}`)
                        },
                        complete : () => {
                            
                            $("#output_result #loader").hide()
                        }
                    })
                }

                loadData() // load at less

                /* insert button on click insert and load data */
                
                $("#insertButton").on("click", function (e) {

                    e.preventDefault()

                    // console.log($("#id").val())

                    $.ajax({
                        url : 'setData.php',
                        type : 'POST',
                        data : {
                            id : $("#id").val(),
                            first_name : $("#first_name").val(),
                            last_name : $("#last_name").val(),
                            gender : $("input:radio[name=gender]:checked").val()
                        },
                        success : (response) => {
                            
                            let return_data = JSON.parse(response)

                            messageBox(return_data.status, return_data.message)
                        },
                        error : (error) => {
                            
                            messageBox(0, ` ajax not inserted : ${error} `)
                        },
                        complete : () => {

                            $("#insertForm").trigger("reset")

                            loadData()                        
                        }
                    })
                })

                /* delete button on click delete and load data */ 

                $(document).on("click", ".deleteButton", function () {
                    
                    let row_id = $(this).attr('value')

                    console.log(row_id)

                    $.ajax({
                        url : 'removeData.php',
                        type : 'POST',
                        data : {
                            deleteId : row_id
                        },
                        success : (response) => {
                            
                            let return_data = JSON.parse(response)
                
                            messageBox(return_data.status, return_data.message)
                        },
                        error : (error) => {
                
                            messageBox(0, ` ajax not deleted : ${error} `)
                        },
                        complete : () => {
                
                            loadData()
                        }
                    })
                })
                
                /* edit button function on click update form set */

                $(document).on("click", ".editButton", function () {

                    $("#updateForm").show("slow")

                    let row_id = $(this).attr('value')

                    // console.log(row_id)

                    $.ajax({
                        url : 'getData.php',
                        type : 'POST',
                        data : {
                            employee_id : row_id
                        },
                        success : (response) => {
                            
                            let return_data = JSON.parse(response)

                            if (return_data.status)
                            {
                                $("#update_id").val(`${return_data.data['id']}`),
                                $("#update_first_name").val(`${return_data.data['fname']}`)
                                $("#update_last_name").val(`${return_data.data['lname']}`)
                                
                                let gender = return_data.data['gender']

                                if(gender == "F")
                                {
                                    $('#updategender1').prop('checked', true)
                                }
                                else if(gender == "M")
                                {
                                    $('#updategender2').prop('checked', true)
                                }
                                else if(gender == "T")
                                {
                                    $('#updategender3').prop('checked', true)
                                }
                            }

                            messageBox(return_data.status, return_data.message)
                        },
                        error : (error) => {

                            messageBox(0, ` ajax not deleted : ${error} `)
                        }
                    })                
                })

                /* update button function on click update file and load data */

                $("#updateButton").on("click", function (e) {

                    e.preventDefault()
                    
                    $.ajax({
                        url : 'updateData.php',
                        type : 'POST',
                        data : {
                            id : $("#update_id").val(),
                            first_name : $("#update_first_name").val(),
                            last_name : $("#update_last_name").val(),
                            gender : $("input:radio[name=updategender]:checked").val()
                        },
                        success : (response) => {
                            
                            let return_data = JSON.parse(response)

                            messageBox(return_data.status, return_data.message)
                        },
                        error : (error) => {

                            messageBox(0, ` ajax not deleted : ${error} `)
                        },
                        complete : () => {

                            $("#updateForm").trigger("reset").hide("slow")

                            loadData()
                        }
                    })
                })

                $("#updateForm").hide()
            })

        </script>

        <!--
            ----------------
            | bootstrap js |
            ----------------
        -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
        <script src="bootstrap.bundle.min.js"></script>

    </body>

    </html>