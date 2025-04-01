/* $.ajax({
    url :  `https://jsonplaceholder.typicode.com/users`,
    type : 'GET',
    beforeSend : () => {

        $("#output-container").html(`
            <div class="spinner-border" role="status" id='loader'>
                <span class="visually-hidden">Loading...</span>
            </div>
        `)
    },
    success : (data) => {

        for (let i = 0; i < data.length; i++) 
        {
            $.each(data[i], (key,value) => {

                if (key == 'address')
                {
                    let address = value

                    $.each(address, (key,value) => {
                        
                        if (key == 'geo')
                        {
                            let geo = value

                            $.each(geo, (key, value) => {
                                $("#output-container").append(`<div class='row'> <div class='col'> ${key} </div> <div class='col text-end'>${value}</div> </div>`)
                            })
                        }
                        else
                        {
                            $("#output-container").append(`<div class='row'> <div class='col'> ${key} </div> <div class='col text-end'>${value}</div> </div>`)
                        }
                    })   
                }
                else if (key == 'company')
                {
                    let company = value

                    $.each(company, (key,value) => {

                        $("#output-container").append(`<div class='row'> <div class='col'> ${key} </div> <div class='col text-end'>${value}</div> </div>`)
                    })
                }
                else
                {
                    $("#output-container").append(`<div class='row'> <div class='col'> ${key} </div> <div class='col text-end'>${value}</div> </div>`)
                }
            })
        }
    },
    error : (error) => {

        $("#output-container").append(`<div class='alert alert-danger'> data fetch error : ${error} </div>`)
    },
    complete : () => {

        $("#output-container #loader").css('display','none')
    }
}) */