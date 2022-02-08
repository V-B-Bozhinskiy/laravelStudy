console.log('Hello, world!!!')

let n = 10

n = 99

const COLOR_RED = '#ff0000'

console.log(COLOR_RED)

//Типы данных

let a = 1;
let b = 0;

let name1 = 'zjkc1231hiw'
console.log(name1, typeof result);

let result = a/b;
console.log(result);
console.log(typeof result); // ; в JS не обязательна но есть какая-то 1 ситуация, в которой без ; всё ломается

console.log(name1 - 1) // NaN = Not a Number

console.log(a + '0') // = 10 (строка). В JS если хоть один из двух операндов сложения строка, 
                     //второй приводятся к строке и происходит сложение (склейка) строк

console.log(2 + 2 +'5') //=45 Но важен порядок операций (для одноуровневых слева-направо). 
                        //Первый плюс как операция сложения чисел (2+2=4), 
                        //а второй уже складывает число и строку, возвращая строку (4+'5'=45 (строка)) 

console.log(2 ** 53 - 1)//Максимальное значение number = 2^53-1 

let bigint = 234112426541531431324n //bigInteger больше number. bigInteger задаётся с n на конце числа
console.log(bigint, typeof bigint);

let flag1 = false //boolean
let flag2 = true
console.log(flag1, typeof flag1);
console.log(flag2, typeof flag2);

let new_result = null //null 
console.log(new_result, typeof new_result)  //в этом случае определяется как 'object' (из-за совместимости) 
                                            //(когда переменная объявлена как null)
let test_result
console.log(test_result, typeof test_result) // а тут определяется как 'undefined'
                                             // (когда переменная не объявлена (значение также undefined))

let person = {              //Объект
    name: 'Вячеслав',
    age: 25
}
console.log(person, typeof person)

//alert, prompt, confirm

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
let numb = 999 //число
let numbString = String(numb) // приведение к строке
console.log(numb, typeof numb)
console.log(numbString, typeof numbString)

stringNumber = Number(numbString) // обратное преобразование строки в число
console.log(stringNumber, typeof stringNumber)

let tstString = 'g24r97f2gf2ygr8'
let NaN_val
NaN_val = Number(tstString)
console.log(Number(tstString)) //=NaN //в случае попытки преобразование нечисла в строке в число

console.log(new_result, Boolean(new_result)) //=false (null)
console.log(test_result, Boolean(test_result)) // = false (undefined)
console.log(numbString, Boolean(numbString)) // = true (String)
console.log(stringNumber, Boolean(stringNumber)) // = true (Number)
console.log(NaN_val, Boolean(NaN_val)) // = false (NaN)

//!
console.log(new_result, Number(new_result)) //  = 0 (null)
console.log(test_result, Number(test_result)) // = NaN (undefined)
//!

console.log(Number('     123     ')) // = 123 - если в строке только цифры и пробелы, 
                                     //пробелы отбросятся и результатом будет ЧИСЛО 123
console.log(Number('     123f     ')) // = NaN - если в строке есть что-то кроме цифр и пробелов
