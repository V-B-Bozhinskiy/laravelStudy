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

// Сравнения

console.log('2 > 5',2 > 5) //=false

let x = 10
let y = 5

console.log('x > y',x > y) //=true
console.log('x == 10',x == 10)//=true

let a = 'a'
let z = 'z'

console.log('a > z',a > z) //=false Сравнение происходит по коду в таблице UNICODE
console.log('z > a',z > a) //=true  Какой символ дальше (с большим кодом) - тот и больше 
let b = 'б'
console.log('б > a',b > a) // true русский алфавит идёт после англ

let str1 = 'abc'
let str2 = 'abb'
console.log('str1 > str2',str1 > str2)//=true сравнение строк происходит ПОСИМВОЛЬНО
                                      // до первого отличающегося символа
str2 = 'abbb'
console.log('str1 > str2',str1 > str2)//=true сравнение не учитывает разное кол-во символов
                                      // и посути дозаполняет нехватающий символ пустым (код 0)

console.log("'1' == 1", '1' == 1) //=true нестрогое сравнение - Типы автоматически приводятся
console.log("'1' === 1", '1' === 1) //=false строгое сравнение - Типы данных влияют на результат

let var1 = ''
let var2 = '0'
let var3 = 0
let var4 = 1
let var5 = '1'
console.log(Boolean(var1)) //=false (пустая строка)
console.log(Boolean(var2)) //=true (так как непустая строка)
console.log(Boolean(var3)) //=false
console.log(Boolean(var4)) //=true
console.log(Boolean(var5)) //=true

console.log('null == undefined', null == undefined) //=true
console.log(Boolean(null)) //=false
console.log(Boolean(undefined)) //=false

console.log('null > 0',null > 0) //=false
console.log('null == 0',null == 0) //=false
console.log('null >= 0',null >= 0) //=true WTF? - wellcome to JS!

console.log('undefined > 0',undefined > 0) //=false так как во всех случаях по приведению будет NaN
console.log('undefined == 0',undefined == 0) //=false
console.log('undefined >= 0',undefined >= 0) //=false

//Условные конструкции
/*
let answer = prompt('какой сейчас год?')

if (answer == 2022){
    alert('Правильно!')
} else if (answer < 2022) {
    alert('Вы из прошлого?')
} else {
    alert('Вы из будущего?')
}
*/
let age = 28
let access = age > 18 ? 'доступ есть' : 'доступа нет'
console.log('access',access)

res = 10 > 5 || 0 > 10

// логические операторы
let haveLicence = true
let number1 = 123
let string1 = ''

res = haveLicence || number1 || string1

if (res){
    console.log('yes')
} else {
    console.log('no')
}

console.log(res) //=true

res =  number1 || string1 || haveLicence

if (res){
    console.log('yes')
} else {
    console.log('no')
}

console.log(res) //=123 (number1) WTF?!
// JS возвращает как значение переменной при || исходное значение ПЕРВОГО приведенного к true!
// либо вернёт ПОСЛЕДНЕЕ, если ни одного true не найдено (даже не false). 

res =  number1 && string1 && haveLicence

if (res){
    console.log('yes')
} else {
    console.log('no')
}
console.log(res)//='' в случае с && как значение переменной возвращается ПЕРВОЕ значение
//, вернувшее false, А иначе возвращается ПОСЛЕДНЕЕ значение (если все в && true)

//циклы
let i = 0
while (i < 10){
    console.log(i++)
}

let j = 0 // область видимости А
for (let j = 0; j < 5; j++){ // при повторном let создаётся область видимости B 
    console.log(j)           // область видимости B
} // в конце for область видимости B уничтожилась !!!!

console.log('j', j) // область видимости А

//досрочный выход из цикла - break
//пропустить итерацию - continue

/*
const answer = prompt('Сколько будет 2+2')

switch (answer){
    case '4': {
        alert('Правильно')
        break
    }
    default:{
        alert('Неправильно')
        break
    }
}
*/

// функции (в функциях лучше не использовать глабальные переменные)

// декларированные функции 
function sayHello(){ //функция объявленная так может использоваться до объявления (как и после)
    str = 'Hello, WORLD!!!' // !!изменение переменной внутри функции ИЗМЕНИТ переменную и вне неё!!
    console.log('внутри функции',str)
}

let str = 'Hello!'
sayHello() //=внутри функции Hello, WORLD!!!
console.log('после функции',str)//=после функции Hello, WORLD!!! (а не Hello!)

let a = 10
let b = 15

function sum(a,b = 0){ //если аргумент функции и переменная имеют одно имя
                       // то присвоение изменит переменную вне функции!
    console.log(a+b)    // b = 0 может не сработать в IE
}

sum2(1);//=1
console.log('a=',a)//=10
sum(a,b);
console.log('b=',b)//=15? - нет, получилось 0

function sum2(a,b){ // способ с поддержкой IE
    if (b === undefined){
        b = 0
    }
    console.log(a+b)
}

function fullname(firstname, lastname){
    return firstname+' '+lastname
}

let username = fullname('test1','test')
console.log('username',username)

// функция, создаваемая как переменная, доступна только после объявления
let sayGoodbye = function () {
    console.log('Goodbye')
}

console.log('sayGoodbye',sayGoodbye)//= Возвращает код функции
sayGoodbye()//= Вызов функции

function callBackExample (access, accept, decline){
    if (access){
        accept()
    } else {
        decline()
    }
}

const accept = function (){
    alert ('Доступ предоставлен')
}

const decline = function (){
    alert ('Доступ запрещён')
}

callBackExample(false, accept, decline) // в callBack передаются функции, которые могут и не вызваться внутри выполнения функции

// стрелочные функции
let arrowFunc = (a,b,c) => a + b + c //если в функции только 1 строка
console.log('arrowFunc',arrowFunc(1,2,3))

// тоже самое что и
arrowFunc = function (a,b,c) {
    return a+b+c
}
console.log('arrowFunc',arrowFunc(4,5,6))

let newArrowFunc = (a,b) => { //стрелочная функция может включать и несколько строк
    console.log('вызвали newArrowFunc') // но тогда они должны быть в {}
    return a+b                          // и return обязателен
}

console.log(newArrowFunc(4,6))

//объекты
let user = {
    name: 'Test', // ключи не нужно помещать в '' если они не многословные, но многословные лучше избегать 
    age: 25
}

console.log(user)

console.log('user.name',user.name) // обращение к свойствам через .

user.age = 29 // перезапись свойства объекта
console.log(user)

delete user.age // удаление свойства из объекта
console.log(user) // свойства age уже НЕТ

user.age = 28 // Добавление свойства (если свойства с таким кодом ещё не было), иначе перезапись
console.log(user)

//цикл по объекту
for (key in user){ //получение каждого свойства в объекте
    console.log(key) // key динамическая переменная = код свойства (каждую итерацию соответствующий)
    console.log(user[key]) // получение значения из свойства объекта с этим динамическим кодом
}

console.log('name' in user)//=true (key in obj) вне for возвращает boolean
console.log('car' in user)//=false есть ли свойство с этим ключем в объекте