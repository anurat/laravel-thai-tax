This Laravel package allows you to calculate personal income tax according to Thai regulations.

Installation

Usage

ThaiTax::netIncome(500000)->incomeTax();
// 9500 THB

ThaiTax::thaiYear(2564)
    ->netIncome(500000)
    ->incomeTax();
// 9500 THB

