<?php
require_once 'AccountInterface.php';

class BankAccount implements AccountInterface {
    const MIN_BALANCE = 0;
    
    protected $balance;
    protected $currency;
    
    public function __construct($currency, $initialBalance = 0) {
        $this->currency = $currency;
        
        if ($initialBalance < self::MIN_BALANCE) {
            throw new Exception("Initial balance cannot be less than " . self::MIN_BALANCE);
        }
        
        $this->balance = $initialBalance;
    }
    
    public function getCurrency() {
        return $this->currency;
    }
    
    public function deposit($amount) {
        if (!is_numeric($amount)) {
            throw new Exception("Amount must be a number");
        }
        
        if ($amount <= 0) {
            throw new Exception("Deposit amount must be positive");
        }
        
        $this->balance += $amount;
        return $this->balance;
    }
    
    public function withdraw($amount) {
        if (!is_numeric($amount)) {
            throw new Exception("Amount must be a number");
        }
        
        if ($amount <= 0) {
            throw new Exception("Withdrawal amount must be positive");
        }
        
        if ($this->balance - $amount < self::MIN_BALANCE) {
            throw new Exception("Insufficient funds");
        }
        
        $this->balance -= $amount;
        return $this->balance;
    }
    
    public function getBalance() {
        return $this->balance;
    }
    
    public function getInfo() {
        return sprintf(
            "Account: Balance: %.2f %s",
            $this->balance,
            $this->currency
        );
    }
}
