/* Window functions */
let isCartProcessing = false;
// Toastr Settings
toastr.options.progressBar = true;
toastr.options.closeButton = true;
toastr.options.preventDuplicates = true;



const debounce = (func, delay) => {
    let timeout;
    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
};

// Color select
const handleColors = (event) => {
    let thisEvent = event;
    let js_colors = document.querySelectorAll('.js_color');
    Array.from(js_colors).forEach(function (js_color) {
        js_color.querySelector('.ti-check').classList.remove('active');
    });

    let colorName = thisEvent.target.closest('a').getAttribute('title');
    document.getElementById('cart_color').value = colorName;
    thisEvent.target.classList.add('active');
};

// Size select
const handleSizes = (event) => {
    let thisEvent = event;
    
    let js_sizes = document.querySelectorAll('.js_size');
    Array.from(js_sizes).forEach(function (js_size) {
        js_size.querySelector('a').classList.remove('active');
    });

     let sizeName = thisEvent.target.closest('a').getAttribute('title');
     document.getElementById('cart_size').value = sizeName;
     thisEvent.target.classList.add('active');
};

// Handle Cart Quantities 
const handleCartInputQuantities = (_token, cartItemId, quantity, routeUrl) => {
   
    let data = '_token=' + _token + '&quantity=' + quantity + '&cartItemId=' + cartItemId;
    if(quantity < 1){
        toastr.error('The product must contain at least one item.', 'Error');
        return;
    }
    ajaxCall(data, routeUrl, _token, function (returnVal) {        
        if (returnVal !== null) {        
            var response = JSON.parse(returnVal);
            if (response.status === 'success') {
                toastr.success(response.msg, 'Success');
                document.getElementById('js_cart_block').innerHTML = response.cart_page_content;
                document.getElementById('js_cartInfo').innerHTML = response.content;                
            } else{
                toastr.error(response.msg, 'Error');
            }
      }
    });

}

/*** Delete Cart Item from Cart deleteCartItem **/
const deleteCartItem = (_token, cartItemId, routeUrl) => {
   
    let data = '_token=' + _token + '&cartItemId=' + cartItemId;

    ajaxCall(data, routeUrl, _token, function (returnVal) {        
        if (returnVal !== null) {        
            var response = JSON.parse(returnVal);
            if (response.status === 'success') {
                let ele_cart_block = document.getElementById('js_cart_block');
                if(ele_cart_block) {
                    ele_cart_block.innerHTML = response.cart_page_content;
                }                   
                document.getElementById('js_cartInfo').innerHTML = response.content;                
                toastr.success(response.msg, 'Success');                
            } else{
                toastr.error(response.msg, 'Error');
            }
      }
    });

}

 

window.addToCart = function(event, product_id, _token, routeUrl, pageOption) {

    let thisEvent = event;
    if (isCartProcessing) return; // Exit if already processing
    isCartProcessing = true;

    let quantity = 1;
    let cartColor = '';
    let cartSize = '';
    const elementQuantity = document.getElementById('quantity');
    if(elementQuantity){ quantity = elementQuantity.value; }

    const elementSize = document.getElementById('cart_size');
    if(elementSize){ cartSize = elementSize.value; }

    const elementColor = document.getElementById('cart_color');
    if(elementColor){ cartColor = elementColor.value; }
    
    if (elementQuantity.value <= 0) {
    toastr.error(
      "Your quantity is " +
        elementQuantity.value +
        " Please increase the Quantity.",
      "Error"
    );
    isCartProcessing = false;
  } else {
    let data =
      "_token=" +
      _token +
      "&quantity=" +
      quantity +
      "&cartSize=" +
      cartSize +
      "&cartColor=" +
      cartColor;
    data = data + "&product_id=" + product_id;

    ajaxCall(data, routeUrl, _token, function (returnVal) {
      if (returnVal !== null) {
        var response = JSON.parse(returnVal);
        if (response.status === "success") {
          toastr.success(response.msg, "Success");
          document.getElementById("js_cartInfo").innerHTML = response.content;
          isCartProcessing = false;
          //thisEvent.innerHTML = response.count;
        }
      }
    });
  }

};

window.mybuynow = function(event, product_id, _token, routeUrl, pageOption) {
  
    let thisEvent = event;
    if (isCartProcessing) return; // Exit if already processing
    isCartProcessing = true;

    let quantity = 1;
    let cartColor = '';
    let cartSize = '';
    const elementQuantity = document.getElementById('quantity');
    if(elementQuantity){ quantity = elementQuantity.value; }

    const elementSize = document.getElementById('cart_size');
    if(elementSize){ cartSize = elementSize.value; }

    const elementColor = document.getElementById('cart_color');
    if(elementColor){ cartColor = elementColor.value; }
    
    if (elementQuantity.value <= 0) {
    toastr.error(
      "Your quantity is " +
        elementQuantity.value +
        " Please increase the Quantity.",
      "Error"
    );
    isCartProcessing = false;
  } else {
    let data = '_token=' + _token + '&quantity=' + quantity + '&cartSize=' + cartSize + '&cartColor=' + cartColor;
    data = data + '&product_id=' + product_id;
  
    ajaxCall(data, routeUrl, _token, function (returnVal) {        
        if (returnVal !== null) {        
            var response = JSON.parse(returnVal);
            if (response.status === 'success') {
                toastr.success(response.msg, 'Success');
                document.getElementById('js_cartInfo').innerHTML = response.content;
                window.location.href = "https://suvlav.com/checkout";

                isCartProcessing = false;
                //thisEvent.innerHTML = response.count;
            }
      }
    });
};
};

var ajaxCall = (data, routeUrl, _token,  callback) => {
    var returnVal = '';
    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', routeUrl, true);
    xhttp.onreadystatechange = function () {
      if (xhttp.readyState != 4 || xhttp.status != 200) return null;
      returnVal = xhttp.responseText;
      callback(returnVal);
    };
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded' );
    xhttp.setRequestHeader('X-CSRF-TOKEN', _token);
    xhttp.send(data);
  };

  /* Easyshop Cookies */
    var easyShopCheckCookie = () => {

            var guest_auth_token = easyShopGetCookie('guest_auth_token');
            if (typeof guest_auth_token === 'undefined' || guest_auth_token === null) {
            var cValue = easyShopRandomString(20);
            easyShopSetCookie('guest_auth_token', cValue, 365);
            }
            
    }
    var easyShopSetCookie = (cName, cValue, expDays) => {        
            let date = new Date();
            date.setTime(date.getTime() + expDays * 24 * 60 * 60 * 1000);
            const expires = 'expires=' + date.toUTCString();
            document.cookie = cName + '=' + cValue + '; ' + expires + '; path=/';

    }

    var easyShopGetCookie = (cName) => {        
        const name = cName + '=';
        const cDecoded = decodeURIComponent(document.cookie); //to be careful
        const cArr = cDecoded.split('; ');
        let res;
        cArr.forEach((val) => {
        if (val.indexOf(name) === 0) res = val.substring(name.length);
        });
        return res;

    }

    var easyShopDeleteCookie = (cName) => {        
        document.cookie = cName + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    }

    var easyShopRandomString = (length) => {
            var randomChars =
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
             var result = '';
            for (var i = 0; i < length; i++) {
                result += randomChars.charAt(
                Math.floor(Math.random() * randomChars.length)
                );
            }
            return result;
    }

    /* Add Listner function trigger 
    ----------------------------------------------------------------*/

    // function call
    window.onload = function(e){ easyShopCheckCookie(); }

    // Color choose for add to Cart
    const js_colors = document.querySelectorAll('.js_color');
    js_colors.forEach(js_color => {    
        js_color.addEventListener('click', debounce(handleColors, 300) );        
    });

    // Color choose for add to Cart
    const js_sizes = document.querySelectorAll('.js_size');
    js_sizes.forEach(js_size => {    
        js_size.addEventListener('click', debounce(handleSizes, 300) );        
    });

