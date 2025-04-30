<?php
require_once 'BankAccount.php';
require_once 'SavingsAccount.php';

function printMessage($message) {
    echo $message . PHP_EOL;
}

function printSeparator() {
    printMessage('---------------------------------------------');
}

printMessage('Bank System Testing');
printSeparator();

try {
    printMessage('1. Creating a regular bank account');
    $account = new BankAccount('USD', 100);
    printMessage($account->getInfo());
    
    printMessage('Depositing 50 USD');
    $account->deposit(50);
    printMessage($account->getInfo());
    
    printMessage('Withdrawing 30 USD');
    $account->withdraw(30);
    printMessage($account->getInfo());
    
    printMessage('Trying to withdraw 200 USD (more than balance)');
    $account->withdraw(200);
} catch (Exception $e) {
    printMessage('Error: ' . $e->getMessage());
}

printSeparator();

try {
    printMessage('2. Trying to create an account with negative initial balance');
    $invalidAccount = new BankAccount('EUR', -50);
} catch (Exception $e) {
    printMessage('Error: ' . $e->getMessage());
}

printSeparator();

try {
    printMessage('3. Trying to deposit a negative amount');
    $account = new BankAccount('USD', 100);
    $account->deposit(-50);
} catch (Exception $e) {
    printMessage('Error: ' . $e->getMessage());
}

printSeparator();

try {
    printMessage('4. Creating a savings account and applying interest');
    
    printMessage('Setting interest rate to 7%');
    SavingsAccount::$interestRate = 0.07;
    
    $savingsAccount = new SavingsAccount('EUR', 1000);
    printMessage($savingsAccount->getInfo());
    
    printMessage('Depositing 500 EUR to savings account');
    $savingsAccount->deposit(500);
    printMessage($savingsAccount->getInfo());
    
    printMessage('Applying interest rate');
    $savingsAccount->applyInterest();
    printMessage($savingsAccount->getInfo());
    
    printMessage('Withdrawing 200 EUR');
    $savingsAccount->withdraw(200);
    printMessage($savingsAccount->getInfo());
} catch (Exception $e) {
    printMessage('Error: ' . $e->getMessage());
}

printSeparator();

try {
    printMessage('5. Demonstrating polymorphism');
    
    $accounts = [
        new BankAccount('USD', 200),
        new SavingsAccount('EUR', 300)
    ];
    
    foreach ($accounts as $i => $account) {
        $accountType = get_class($account);
        printMessage("Account #{$i} ({$accountType}):");
        printMessage($account->getInfo());
        
        printMessage("- Depositing 100");
        $account->deposit(100);
        printMessage("- New balance: " . $account->getBalance() . " " . $account->getCurrency());
        
        if ($account instanceof SavingsAccount) {
            printMessage("- Applying interest");
            $account->applyInterest();
            printMessage("- Balance after interest: " . $account->getBalance() . " " . $account->getCurrency());
        }
        
        printMessage('');
    }
} catch (Exception $e) {
    printMessage('Error: ' . $e->getMessage());
}

printSeparator();
printMessage('Testing completed');
