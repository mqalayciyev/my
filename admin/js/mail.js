$(document).ready(function(){
    let checked = false;
    let id = []
    $(".btn-reload").click((e) => {
        location.reload()
    })
    $("#check-all-list").click(function(event){
        id = [];
        if(event.target.tagName == "I"){
            event.target.classList.toggle("fa-check-square")
            event.target.classList.toggle("fa-square")
        }
        else{
            $("#check-all-list").find(".far").toggleClass(function() {
                if ( $( this ).is( ".fa-square" ) ) {
                    $( this ).removeClass("fa-square")
                    return "fa-check-square";
                } else {
                    $( this ).removeClass("fa-check-square")
                    return "fa-square";
                }
              });
        }
        let inputs = $(".mailbox-messages").find(".icheck-primary").find("input[type='checkbox']")
        for(let i = 0; i<inputs.length; i++){
            
            if(!checked){
                inputs[i].checked = true;
                id.push(inputs[i].id)
            }
            else{
                inputs[i].checked = false;
            }
            
        }
        checked = !checked;
        console.log([...id]);
    })

    $(".btn-trash").click(function(){
        if(id.length > 0){
            $.ajax({
                url: "config.php",
                method: "POST", 
                data: {query: "trash_mail", id: id},
                success: function(data){
                    location.reload()
                }
            })
        }
        else{
            let inputs = $(".mailbox-messages").find(".icheck-primary").find("input[type='checkbox']")
            for(let i = 0; i<inputs.length; i++){
            
                if(inputs[i].checked == true){
                    id.push(inputs[i].id)
                }
                
            }
            if(id.length > 0){
                $.ajax({
                    url: "config.php",
                    method: "POST", 
                    data: {query: "trash_mail", id: id},
                    success: function(data){
                        location.reload()
                    }
                })
            }
        }
    })
    if(location.href.search("trash") != -1 || location.href.search("archive") != -1){
        let archive = (location.href.search("archive") != -1) ? true :false;
        $(".btn-folder").click(function(){
            if(id.length > 0){
                $.ajax({
                    url: "config.php",
                    method: "POST", 
                    data: {query: "move_mail", id, archive},
                    success: function(data){
                        location.reload()
                    }
                })
            }
            else{
                let inputs = $(".mailbox-messages").find(".icheck-primary").find("input[type='checkbox']")
                for(let i = 0; i<inputs.length; i++){
                
                    if(inputs[i].checked == true){
                        id.push(inputs[i].id)
                    }
                    
                }
                if(id.length > 0){
                    $.ajax({
                        url: "config.php",
                        method: "POST", 
                        data: {query: "move_mail", id, archive},
                        success: function(data){
                            location.reload()
                        }
                    })
                }
            }
        })
    }
    else{
        $(".btn-archive").click(function(){
            if(id.length > 0){
                $.ajax({
                    url: "config.php",
                    method: "POST", 
                    data: {query: "mail_archive", id},
                    success: function(data){
                        console.log(data);
                        location.reload()
                    }
                })
            }
            else{
                let inputs = $(".mailbox-messages").find(".icheck-primary").find("input[type='checkbox']")
                for(let i = 0; i<inputs.length; i++){
                
                    if(inputs[i].checked == true){
                        id.push(inputs[i].id)
                    }
                    
                }
                if(id.length > 0){
                    $.ajax({
                        url: "config.php",
                        method: "POST", 
                        data: {query: "mail_archive", id},
                        success: function(data){
                            console.log(data); 
                            location.reload()
                        }
                    })
                }
            }
        })
    }
    
    
})