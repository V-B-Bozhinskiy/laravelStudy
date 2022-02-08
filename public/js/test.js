/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/test.js ***!
  \******************************/
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

console.log('Hello, world!!!');
var n = 10;
n = 99;
var COLOR_RED = '#ff0000';
console.log(COLOR_RED); //Типы данных

var a = 1;
var b = 0;
var name1 = 'zjkc1231hiw';
console.log(name1, _typeof(result));
var result = a / b;
console.log(result);
console.log(_typeof(result)); // ; в JS не обязательна но есть какая-то 1 ситуация, в которой без ; всё ломается

console.log(name1 - 1); // NaN = Not a Number

console.log(a + '0'); // = 10 (строка). В JS если хоть один из двух операндов сложения строка, 
//второй приводятся к строке и происходит сложение (склейка) строк

console.log(2 + 2 + '5'); //=45 Но важен порядок операций (для одноуровневых слева-направо). 
//Первый плюс как операция сложения чисел (2+2=4), 
//а второй уже складывает число и строку, возвращая строку (4+'5'=45 (строка)) 

console.log(Math.pow(2, 53) - 1); //Максимальное значение number = 2^53-1 

var bigint = 234112426541531431324n; //bigInteger больше number. bigInteger задаётся с n на конце числа

console.log(bigint, _typeof(bigint));
var flag1 = false; //boolean

var flag2 = true;
console.log(flag1, _typeof(flag1));
console.log(flag2, _typeof(flag2));
var new_result = null; //null 

console.log(new_result, _typeof(new_result)); //в этом случае определяется как 'object' (из-за совместимости) 
//(когда переменная объявлена как null)

var test_result;
console.log(test_result, _typeof(test_result)); // а тут определяется как 'undefined'
// (когда переменная не объявлена (значение также undefined))

var person = {
  //Объект
  name: 'Вячеслав',
  age: 25
};
console.log(person, _typeof(person)); //alert, prompt, confirm
//alert('Вот такое сообщение') //Вызовет окно с текстом "Вот такое сообщение" и кнопкой ОК. 
//До нажатия на ОК выполнение этого JS кода будет приостановлено (на паузе).
//console.log(typeof alert) // Определяется как тип 'function', но по факту объект 
//let age = prompt('How old are you?') // Окно с текстом "How old are you?", Input (строкой ввода) 
//и кнопкой ОК. Введенное в input возвращается как результат
//let test2 = prompt('How old are you?', 'default value') // в input вносится default value - обязательно для IE
//console.log(age, typeof age)
//let access = confirm('Text') //Окно с текстом "Text" и кнопками OK и Отмена
//console.log(access, typeof access) // Ок (или нажатие enter) возвращает true, 
// Отмена (или нажатие Esc) возвращает false
//Приведение типов

var numb = 999; //число

var numbString = String(numb); // приведение к строке

console.log(numb, _typeof(numb));
console.log(numbString, _typeof(numbString));
stringNumber = Number(numbString); // обратное преобразование строки в число

console.log(stringNumber, typeof stringNumber === "undefined" ? "undefined" : _typeof(stringNumber));
var tstString = 'g24r97f2gf2ygr8';
var NaN_val;
NaN_val = Number(tstString);
console.log(Number(tstString)); //=NaN //в случае попытки преобразование нечисла в строке в число

console.log(new_result, Boolean(new_result)); //=false (null)

console.log(test_result, Boolean(test_result)); // = false (undefined)

console.log(numbString, Boolean(numbString)); // = true (String)

console.log(stringNumber, Boolean(stringNumber)); // = true (Number)

console.log(NaN_val, Boolean(NaN_val)); // = false (NaN)
//!

console.log(new_result, Number(new_result)); //  = 0 (null)

console.log(test_result, Number(test_result)); // = NaN (undefined)
//!

console.log(Number('     123     ')); // = 123 - если в строке только цифры и пробелы, 
//пробелы отбросятся и результатом будет ЧИСЛО 123

console.log(Number('     123f     ')); // = NaN - если в строке есть что-то кроме цифр и пробелов
/******/ })()
;