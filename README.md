# laravel-thai-tax

This Laravel package allows you to calculate personal income tax according to Thai regulations.

## Installation

Tested on Laravel 8 but should be working on any version of Laravel.

```
composer require anurat/laravel-thai-tax
```

After installed, it can be used through `ThaiTax` facade.

```
use ThaiTax;
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

### Incomes and Deductions

Net income can be calculated by using incomes and deductions,  
so incomes and deductions can be provided instead of net income.

> `netIncome()` and (all types or incomes and deductions) should not be used together,
> as they will override each other.

#### Income

`income(float $income)` can be used for general type of incomes

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
    ->bonus(50000)
    ->incomeTax();
// 41000 THB    
```
> salary() takes monthly salary as an argument so 50,000 will be 600,000 per year.

`income(array $incomes)` can also accept an array as an argument.

```php
ThaiTax::thaiYear(2564)
    ->income([
        50000,
        50000,
        'salary' => 50000,
        'bonus' => 50000
    ])
    ->incomeTax();
// 41000 THB    
```


#### Deduction

For general type of deductions `deduction()` can be used.

```php
ThaiTax::thaiYear(2564)
    ->income(500000)
    ->deduction(100000)
    ->incomeTax();
// 4500 THB    
```

Other deduction types are as follow.  
It has the benefit of checking for specific rules for that type  
e.g. home loan interest may not exceed 100,000 Baht,  
it will automatically reduce to 100,000 Baht if more is provided.

`spouse(bool $hasSpouse)` // คู่สมรส

`children(int $noOfChildren)` // บุตร

`parents(int $noOfParents)` // บิดามารดา

`disabiltites(int $noOfDisabilities)` // ผู้พิการ/ทุพพลภาพ

`childBirth(float $cost)` // ฝากครรภ์และทำคลอด

`insurancePremium(float $premium)` // ประกันชีวิต

`annuityInsurancePremium(float $premium)` // ประกันชีวิตแบบบำนาญ

`homeLoanInterest(float $interest)` // ดอกเบี้ยซื้อที่อยู่อาศัย

`providentFund(float $fund)` // กองทุนสำรองเลี้ยงชีพ

`socialSecurity(float $security)` // ประกันสังคม

`donation(float $donation)` // บริจาค

`educationDonation(float $donation)` // บริจาคเพื่อการศึกษา/กีฬา

`politicalParty(float $donation)` // บริจาคพรรคการเมือง

`shopDeeMeeKeun(float $shop)` // ช๊อปดีมีคืน



```php
ThaiTax::thaiYear(2564)
    ->income(1000000)
    ->spouse(true)
    ->children(2)
    ->parents(3)
    ->insurancePremium(50000)
    ->incomeTax();
// 39500 THB    
```

`deduction()` can also accept an array as an argument.

```php
ThaiTax::thaiYear(2564)
    ->income(1000000)
    ->deduction([
        'spouse' => true,
        'children' => 2,
        'parents' => 3,
        'insurancePremium' => 50000
    ])
    ->incomeTax();
// 39500 THB    
```
