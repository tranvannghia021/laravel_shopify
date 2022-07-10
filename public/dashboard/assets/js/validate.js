
// Đối tượng `Validator`
function Validator(options) {
    function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }
    var selectorRules = {};

    // Hàm thực hiện validate
    function validate(inputElement, rule) {
        var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
        var errorMessage;

        // Lấy ra các rules của selector
        var rules = selectorRules[rule.selector];

        // Lặp qua từng rule & kiểm tra
        // Nếu có lỗi thì dừng việc kiểm
        for (var i = 0; i < rules.length; ++i) {
            switch (inputElement.type) {
                case 'radio': // tự viết cho radio
                case 'checkbox':
                    errorMessage = rules[i](formElement.querySelector(rule.selector + ':checked'));
                    break;
                default:
                    errorMessage = rules[i](inputElement.value);
            }
            if (errorMessage) break;
        }

        if (errorMessage) {
            errorElement.innerText = errorMessage;
            getParent(inputElement, options.formGroupSelector).classList.add('invalid');
        } else {
            errorElement.innerText = '';
            getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
        }

        return !errorMessage;
    }

    // Lấy element của form cần validate
    var formElement = document.querySelector(options.form);
    if (formElement) {
        // Khi submit form
        formElement.onsubmit = function (e) {
            e.preventDefault(); /// xoa bỏ hành vi mặc đinh khi Submit của form

            var isFormValid = true;

            // Lặp qua từng rules và validate
            options.rules.forEach(function (rule) {
                var inputElement = formElement.querySelector(rule.selector);
                var isValid = validate(inputElement, rule);
                if (!isValid) {
                    isFormValid = false;
                }
            });

            if (isFormValid) {
                // Trường hợp submit với javascript
                if (typeof options.onSubmit === 'function') {
                    var enableInputs = formElement.querySelectorAll('[name]');
                    var formValues = Array.from(enableInputs).reduce(function (values, input) {
                        switch (input.type) {
                            case 'radio':
                                values[input.name] = formElement.querySelector(
                                    'input[name="' + input.name + '"]:checked',
                                ).value;
                                break;
                            case 'checkbox':
                                if (!input.matches(':checked')) {
                                    values[input.name] = '';
                                    return values;
                                }
                                if (!Array.isArray(values[input.name])) {
                                    values[input.name] = [];
                                }
                                values[input.name].push(input.value);
                                break;
                            case 'file':
                                values[input.name] = input.files;
                                break;

                            default:
                                values[input.name] = input.value;
                        }

                        return values;
                    }, {});
                    options.onSubmit(formValues);
                }
                // Trường hợp submit với hành vi mặc định
                else {
                    formElement.submit();
                }
            }
        };

        // Lặp qua mỗi rule và xử lý (lắng nghe sự kiện blur, input, ...)
        options.rules.forEach(function (rule) {
            // Lưu lại các rules cho mỗi input
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
            } else {
                selectorRules[rule.selector] = [rule.test];
            }

            var inputElements = formElement.querySelectorAll(rule.selector);

            Array.from(inputElements).forEach(function (inputElement) {
                // Xử lý trường hợp blur khỏi input
                inputElement.onblur = function () {
                    validate(inputElement, rule);
                };

                // Xử lý mỗi khi người dùng nhập vào input
                inputElement.oninput = function () {
                    var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(
                        options.errorSelector,
                    );
                    errorElement.innerText = '';
                    getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
                };
            });
        });
    }
}

// Định nghĩa rules
// Nguyên tắc của các rules:
// 1. Khi có lỗi => Trả ra message lỗi
// 2. Khi hợp lệ => Không trả ra cái gì cả (undefined)
Validator.isRequired = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            return value ? undefined : message || 'Vui lòng nhập trường này';
        },
    };
};

Validator.isNumber = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^\d+$/;
            return regex.test(value) ? undefined : message || 'Trường này phải là số nguyên dương';
        },
    };
};
// check sản phẩm tồn tại hay k
Validator.isCheck = function (selector, array, message) {
    return {
        selector: selector,
        test: function (value) {
            var namenew = array.filter((e) => e.name == value.trim());

            return namenew.length <= 0 ? undefined : message || 'Tên đã tồn tại';
        },
    };
};
// check email tồn tại
Validator.isEmailCheck = function (selector, array, message) {
    return {
        selector: selector,
        test: function (value) {
            var namenew = array.filter((e) => e.email == value.trim());
            return namenew.length <= 0 ? undefined : message || 'Email đã tồn tại';
        },
    };
};

Validator.isRealNumber = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^(\+|-)?((\d+(\.\d+)?)|(\[0].\d+))$/;
            return regex.test(value) ? undefined : message || 'Trường này phải là số thực';
        },
    };
};
Validator.isEmail = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-A0-9\-])+\.)+([a-zA-Z0-9]{2,5})$/;
            return regex.test(value) ? undefined : message || 'Trường này phải là email';
        },
    };
};
Validator.isPhoneNumber = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^0[3|7|8|9|5]\d{7,8}$/;
            return regex.test(value) ? undefined : message || 'Trường này phải là số điện thoại';
        },
    };
};

Validator.minLength = function (selector, min, message) {
    return {
        selector: selector,
        test: function (value) {
            return value.length >= min ? undefined : message || `Vui lòng nhập tối thiểu ${min} kí tự`;
        },
    };
};

Validator.isConfirmed = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            return value === getConfirmValue() ? undefined : message || 'Giá trị nhập vào không chính xác'; // nếu  message bằng null thì sẽ lấy 'Gia trị nhập vào không chính xác'
        },
    };
};
Validator.isConfirmedFail = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            return value !== getConfirmValue() ? undefined : message || 'Giá trị nhập vào không chính xác'; // nếu  message bằng null thì sẽ lấy 'Gia trị nhập vào không chính xác'
        },
    };
};
Validator.isTommorrow = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            let start_date = new Date(getConfirmValue());
            let end_date = new Date(value);
            return end_date.getTime() - start_date.getTime() >= 86400
                ? undefined
                : message || 'Giá trị nhập vào không chính xác';
        },
    };
};
Validator.isEndDate = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            let start_date = new Date(getConfirmValue());
            let end_date = new Date(value);
            return end_date.getTime() - start_date.getTime() >= 1209600000
                ? undefined
                : message || 'Giá trị nhập vào không chính xác';
        },
    };
};
Validator.isOld = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            let old_start = getConfirmValue();
            let old_end = value;
            return old_end - old_start > 0 ? undefined : message || 'Giá trị nhập vào không chính xác';
        },
    };
};
Validator.isImage = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var typeImg = value.slice(value.indexOf('.'), value.length);
            switch (typeImg) {
                case '.png':
                case '.jpg':
                case '.jpeg':
                case '.gif':
                    // console.log("Is Image");
                    break;
                default:
                    return message || 'Vui lòng chọn ảnh là png,jpg,jpeg và gif';
            }
        },
    };
};

const ValidateImageSize = (selector) => {
    const fileSelector = document.querySelector(selector);
    fileSelector.onchange = (e) => {
        if (e.target.files[0].size > 2097152) {
            alert('Image size is not allowed to exceed 2MB');
            fileSelector.value = null;
        }
    };
};

/*
  cách dùng
  document.addEventListener('DOMContentLoaded', function() {
        Validator({
            form: '#form-search-import',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
               
            
                Validator.isTommorrow('#end_date', function () {
                      return document.querySelector('#form-search-import #start_date').value;
                    }, 'Ngày chọn không hợp lệ')
                
  
            ],
            
  
        })
    });
  
  */
