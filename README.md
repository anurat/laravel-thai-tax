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

> The earliest year you can use is 2542

### Income and deduction


### clearData

