<?php
require_once 'BankAccount.php';

class SavingsAccount extends BankAccount {
    public static $interestRate = 0.05;
    
    public function applyInterest() {
        $interest = $this->balance * self::$interestRate;
        $this->balance += $interest;
        return $this->balance;
    }
    
    public function getInfo() {
        return sprintf(
            "Savings Account: Balance: %.2f %s, Interest Rate: %.2f%%",
            $this->balance,
            $this->currency,
            self::$interestRate * 100
        );
    }
}
