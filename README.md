# laravel-thai-tax

This Laravel package allows you to calculate personal income tax according to Thai regulations.

## Installation

```
composer require anurat/laravel-thai-tax
```

## Usage

The simplest use of the library is to provide `netIncome()` (THB)  
then call `incomeTax()`

```php
ThaiTax::netIncome(500000)->incomeTax();
// 9500 THB
```

Net income is total incomes minus total expenses minus total deductions.  
It is then used to calculate income tax according to personal income tax rate  
e.g. https://www.rd.go.th/59670.html

### Thai year

You can also provide Thai year to calculate different income tax on different year as follow.

> If Thai year is not provided, the current year is used.


```php
ThaiTax::thaiYear(2542)
    ->netIncome(500000)
    ->incomeTax();
// 42500 THB
```

> The earliest year it can calculate is 2542

### Income

Net income can be calculated by using incomes and deductions,  
so incomes and deductions can be provided instead of net income.

`income(float $income)` can be used for general type of incomes, and  

```php
ThaiTax::thaiYear(2564)
    ->income(250000)
    ->income(50000)
    ->income(15000)
    ->incomeTax();
// 250 THB    
```

Also you can use more specific type of incomes  
e.g. `salary(float $salaryPerMonth)` or `bonus(float $bonus)`.

```php
ThaiTax::thaiYear(2564)
    ->income(100000)
    ->salary(50000)
    ->bonus(50000);
// 41000 THB    
```

> salary() takes monthly salary as an argument so 50,000 will be 600,000 per year.

### Deduction




