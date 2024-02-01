function add_product(id)
{ 
    let form=new FormData(); 
    form.append('product_id', id); 
    let request_options={method: 'POST', body: form}; 
    fetch('https://up-titova.xn--80ahdri7a.site/cart/create', request_options)     
    .then(response=>response.text())     
    .then(result=>{         
        console.log(result)         
        let title=document.getElementById('staticBackdropLabel');         
        let body=document.getElementById('modalBody');         
        if (result=='false'){             
            title.innerText='Ошибка';             
            body.innerHTML="<p>Ошибка добавления товара, вероятно, товар уже раскупили</p>"         
        } else {             
            title.innerText='Информационное сообщение';             
            body.innerHTML="<p>Товар успешно добавлен в корзину</p>"         
        }         
        let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});         
        myModal.show();              
    }) 
}



function create_order()
{
    let card = document.getElementById('card');
    let pass = document.getElementById('pass').value;

    let form=new FormData(); 
    form.append('password', pass); 
    let request_options={method: 'POST', body: form}; 
    fetch('https://up-titova.xn--80ahdri7a.site/orders/create', request_options)     
    .then(response=>response.text())     
    .then(result=>{  
        console.log(result)                
        let title=document.getElementById('staticBackdropLabel');         
        let body=document.getElementById('modalBody');         
        if (result=='false'){             
            title.innerText='Неверный пароль';             
            body.innerHTML="<p>Заказ не оформлен</p>"         
        } else {         
            title.innerText='Информационное сообщение';             
            body.innerHTML="<p>Заказ оформлен</p>"  
            card.remove();
            
      
        }   
        let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});         
        myModal.show();    
    })

}


function plus_count(id)
{
    let form=new FormData(); 
    form.append('id', id);
    let request_options={method: 'POST', body: form}; 
    fetch('https://up-titova.xn--80ahdri7a.site/cart/plus', request_options)     
    .then(response=>response.text())     
    .then(result=>{         
        console.log(result)         
        let title=document.getElementById('staticBackdropLabel');         
        let body=document.getElementById('modalBody');         
        if (result=='false'){             
            title.innerText='Ошибка';             
            body.innerHTML="<p>Товар уже раскупили</p>"         
                
        let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});         
        myModal.show();
        }
    })

}

function minus_count(id)
{
    let form=new FormData(); 
    form.append('id', id);
    let request_options={method: 'POST', body: form}; 
    fetch('https://up-titova.xn--80ahdri7a.site/cart/minus', request_options)     
    .then(response=>response.text())     
    .then(result=>{         
        console.log(result)         
        let title=document.getElementById('staticBackdropLabel');         
        let body=document.getElementById('modalBody');         
        if (result=='false'){             
            title.innerText='Ошибка';             
            body.innerHTML="<p>В корзине нет данного товара</p>"         
                
        let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});         
        myModal.show();
        }
        
    })

}



function del_ord(id)
{
    let form=new FormData(); 
    form.append('id', id); 
    let request_options={method: 'POST', body: form}; 
    fetch('https://up-titova.xn--80ahdri7a.site/orders/del', request_options)     
    .then(response=>response.text())     
    .then(result=>{  
        console.log(result)                
        let title=document.getElementById('staticBackdropLabel');         
        let body=document.getElementById('modalBody');         
        if (result=='false'){             
            title.innerText='Ошибка';             
            body.innerHTML="<p>Заказ не удален</p>"         
        } else {             
            title.innerText='Информационное сообщение';             
            body.innerHTML="<p>Заказ удален</p>"         
        }         
        let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});         
        myModal.show();    
    })

}
