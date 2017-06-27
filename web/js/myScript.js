
var summ =  parseInt( prompt('Введите сумму вклада', 100) );

//console.log(summ);
document.write('<p>' + 'Сумма вклада: ' + summ +  '</p>');

var persent = parseInt( prompt('Введите процент по вкладу:', '13%') );
document.write('<p>Процентпо вкладу составляет: ' +  persent  + '<p>');

var inCome = summ + summ*persent/100;
document.write('Сумма накопления: ' + inCome);
