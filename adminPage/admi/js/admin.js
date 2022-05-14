// đối tượng Validator
function Validator(options) {
    
    function getParent(element, selector) {
        // nếu elenment còn tk cha thì mé lặp
        while(element.parentElement) {
            if(element.parentElement.matches(selector))
            return element.parentElement        
        }
         element = element.parentElement      
    }
var  selectorRules = {};
    // hàm thực hiện validate
    function validate(inputElement, rule) {
       
         // lấy value : inputElement.value
                    //  test : rule.test
                    // truyền dữ liệu vào hàm là value input nếu không có value thì hàm đó tự trả về message lỗi
                    // kiếm tk cha r nhảy vào tk con khác  
                    var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector)
                    var errorMessage ;
                    //  lấy qua các rule, các rule nằm trong key selectorRules[rule.selector] là 1 mảng
                    var rules = selectorRules[rule.selector] // mảng các func

                     for( var i = 0 ; i < rules.length ; ++i) {
                        switch (inputElement.type) {
                            case 'checkbox':
                            case "radio":
                                errorMessage = rules[i](
                                    formElement.querySelector(rule.selector + ':checked')
                                );
                                break;
                            default:
                                errorMessage = rules[i](inputElement.value);
                        }
                        //  lặp qua từng rule của từng key xong kiểm tra có 1 lỗi thì dừng
                        // chỗ này là truyền value dô từng func có nghĩa là cái test của từng tk rule
                        if(errorMessage){

                            break;
                        }

                    }
                    // nếu có lỗi trả về nếu như value truyền vào validator lỗi thì nó trả về cái 
                    //  vui lòng nhập trường này
                    // còn nếu không lỗi thì nó trả về undefine
                    if(errorMessage)
                    {
                        errorElement.innerText = errorMessage;
                        getParent(inputElement, options.formGroupSelector).classList.add('invalid');
                    }else {
                        errorElement.innerText= '';
                        getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
                    }
                    return !errorMessage
    }
    // lấy element của form
    var formElement = document.querySelector(options.form);
    
    if(formElement) {
        formElement.onsubmit = function (e){
            e.preventDefault();
            var isFormValid  = true
            // lặp qua từng rule và validate
            options.rules.forEach(function (rule) { 
                var inputElement = formElement.querySelector(rule.selector)
                 isValid = validate(inputElement, rule);
                if(!isValid){
                    isFormValid = false;
                }
            });
            if(isFormValid)
            {
                if(typeof options.onSubmit === 'function'){
                    var EnableInputs = formElement.querySelectorAll('[name]')
                    var formValues = Array.from(EnableInputs).reduce(function (values, input) {
                        switch(input.type){
                        case 'checkbox':
                        case "radio":
                              
                               values[input.name]= formElement.querySelector('input[name="'+ input.name + '"]:checked').value
                                break;
                        default:
                                values[input.name]= input.value
                            }
                   
                    return  values            
                    }, {})
                    options.onSubmit(formValues)
                    formElement.submit();
                    
            // submit vs hành vi mặc định
                }
            }
            
            
        }
        // rule của hàm này là từng phần tử của form
        options.rules.forEach(function (rule) { 

            if(Array.isArray(selectorRules[rule.selector])){
                // đã đc gán r thì push (thêm) vào
                selectorRules[rule.selector].push(rule.test)
            }
            else {
                //  lần đâu tiên chạy
                // lưu rule lấy dạng hàm
                // mỗi key sẽ là 1 mảng
                 // chú ý [rule.test] là cái mảng này tk ngu cấu trúc tạo mảng var a = [ 1, 2 ,3]
                selectorRules[rule.selector] = [rule.test] // rule.test là lấy 1 cái func ché ch truyền tham số 
            }
            // element của input
            //  rule.selector là từ thằng rule trả về rule là mấy cái validator.requied ....
            var inputElements = formElement.querySelectorAll(rule.selector)
          // var errorMessage = rule.test(inputElement.value);  
          Array.from(inputElements).forEach(function (inputElement){
                 // Xử lí trường hợp blur khỏi input
                 inputElement.onblur = function () {
                    validate(inputElement, rule)
                }
                // Xử lí mỗi khi người dùng đang nhập
                inputElement.oninput = function () {
                    var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector)
                    
                    //  Đang nhập thì bỏ đi message lỗi và bỏ boder đi
                    errorElement.innerText= '';
                    getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
                }
          })
        });
    }

}
// định nghĩa các rules ( luật lệ)
//  nguyên tắc khi có lỗi thì trả ra message lỗi
// khi không có lỗi không trả ra gì undefine

Validator.isRequied = function( selector ) {
    return {
        selector: selector,
        // value của input
        test: function(value) {
            // trim() loại bỏ dấu cách nhập vào
            return value ? undefined : ' vui lòng nhập trường này'
        }
    }
}
Validator.isGmail = function( selector ) {
    return {
        selector: selector,
        test: function(value) {
            var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
            // regex.test(value) kiểm tra cái test(value) có phải trả về value là định dạng gmail hay k 
            // nếu có thì true ngc lại flase
            return regex.test(value) ? undefined : 'Trường này phải là email'
        }
    }
}

Validator.minLength = function( selector, min) {
    return {
        selector: selector,
        test: function(value) {
            return value.length >= min ? undefined : `Trường này phải đủ ${min} kí tự`;
        }
    }
}

Validator.isRepassword = function( selector, getConfirmValue , customMessage) {
    return {
        selector: selector,
        //  muốn giá trị nhập vào phải trùng cái trả về của getConfirmValue
        test: function(value) {
            //  custom message muốn hiện thông báo gì thì hiện chỉ cần thêm cái đối số bên validator.rules./....
            return value == getConfirmValue() ? undefined : customMessage || ' giá trị nhập vào không chính xác';     
           }
    }
}
// // Đối tượng `Validator`
// function Validator(options) {
//     function getParent(element, selector) {
//         while (element.parentElement) {
//             if (element.parentElement.matches(selector)) {
//                 return element.parentElement;
//             }
//             element = element.parentElement;
//         }
//     }

//     var selectorRules = {};

//     // Hàm thực hiện validate
//     function validate(inputElement, rule) {
//         var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
//         var errorMessage;

//         // Lấy ra các rules của selector
//         var rules = selectorRules[rule.selector];
        
//         // Lặp qua từng rule & kiểm tra
//         // Nếu có lỗi thì dừng việc kiểm
//         for (var i = 0; i < rules.length; ++i) {
//             switch (inputElement.type) {
//                 case 'radio':
//                 case 'checkbox':
//                     errorMessage = rules[i](
//                         formElement.querySelector(rule.selector + ':checked')
//                     );
//                     break;
//                 default:
//                     errorMessage = rules[i](inputElement.value);
//             }
//             if (errorMessage) break;
//         }
        
//         if (errorMessage) {
//             errorElement.innerText = errorMessage;
//             getParent(inputElement, options.formGroupSelector).classList.add('invalid');
//         } else {
//             errorElement.innerText = '';
//             getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
//         }

//         return !errorMessage;
//     }

//     // Lấy element của form cần validate
//     var formElement = document.querySelector(options.form);
//     if (formElement) {
//         // Khi submit form
//         formElement.onsubmit = function (e) {
//             e.preventDefault();

//             var isFormValid = true;

//             // Lặp qua từng rules và validate
//             options.rules.forEach(function (rule) {
//                 var inputElement = formElement.querySelector(rule.selector);
//                 var isValid = validate(inputElement, rule);
//                 if (!isValid) {
//                     isFormValid = false;
//                 }
//             });

//             if (isFormValid) {
//                 // Trường hợp submit với javascript
//                 if (typeof options.onSubmit === 'function') {
//                     var enableInputs = formElement.querySelectorAll('[name]');
//                     var formValues = Array.from(enableInputs).reduce(function (values, input) {
                        
//                         switch(input.type) {
//                             case 'radio':
//                                 values[input.name] = formElement.querySelector('input[name="' + input.name + '"]:checked').value;
//                                 break;
//                             case 'checkbox':
//                                 if (!input.matches(':checked')) {
//                                     values[input.name] = '';
//                                     return values;
//                                 }
//                                 if (!Array.isArray(values[input.name])) {
//                                     values[input.name] = [];
//                                 }
//                                 values[input.name].push(input.value);
//                                 break;
//                             case 'file':
//                                 values[input.name] = input.files;
//                                 break;
//                             default:
//                                 values[input.name] = input.value;
//                         }

//                         return values;
//                     }, {});
//                     options.onSubmit(formValues);
//                 }
//                 // Trường hợp submit với hành vi mặc định
//                 else {
//                     formElement.submit();
//                 }
//             }
//         }

//         // Lặp qua mỗi rule và xử lý (lắng nghe sự kiện blur, input, ...)
//         options.rules.forEach(function (rule) {

//             // Lưu lại các rules cho mỗi input
//             if (Array.isArray(selectorRules[rule.selector])) {
//                 selectorRules[rule.selector].push(rule.test);
//             } else {
//                 selectorRules[rule.selector] = [rule.test];
//             }

//             var inputElements = formElement.querySelectorAll(rule.selector);

//             Array.from(inputElements).forEach(function (inputElement) {
//                // Xử lý trường hợp blur khỏi input
//                 inputElement.onblur = function () {
//                     validate(inputElement, rule);
//                 }

//                 // Xử lý mỗi khi người dùng nhập vào input
//                 inputElement.oninput = function () {
//                     var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
//                     errorElement.innerText = '';
//                     getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
//                 } 
//             });
//         });
//     }

// }



// // Định nghĩa rules
// // Nguyên tắc của các rules:
// // 1. Khi có lỗi => Trả ra message lỗi
// // 2. Khi hợp lệ => Không trả ra cái gì cả (undefined)
// Validator.isRequired = function (selector, message) {
//     return {
//         selector: selector,
//         test: function (value) {
//             return value ? undefined :  message || 'Vui lòng nhập trường này'
//         }
//     };
// }

// Validator.isEmail = function (selector, message) {
//     return {
//         selector: selector,
//         test: function (value) {
//             var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
//             return regex.test(value) ? undefined :  message || 'Trường này phải là email';
//         }
//     };
// }

// Validator.minLength = function (selector, min, message) {
//     return {
//         selector: selector,
//         test: function (value) {
//             return value.length >= min ? undefined :  message || `Vui lòng nhập tối thiểu ${min} kí tự`;
//         }
//     };
// }

// Validator.isConfirmed = function (selector, getConfirmValue, message) {
//     return {
//         selector: selector,
//         test: function (value) {
//             return value === getConfirmValue() ? undefined : message || 'Giá trị nhập vào không chính xác';
//         }
//     }
// }
