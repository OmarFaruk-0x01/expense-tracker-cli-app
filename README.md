# Income-Expense Tracker

# Objectives
Create an Income-Expense Tracker initially run on CLI. Trying to follow OOP in this whole project and also design principals. Implement storage for persisting data.

# Core Parts
- Feature
- View
- Storage

# Implementation

- **Feature**
  - New Feature can be added by extending the `Feature` abstract class and implementing the abstract method.
  - Register the new feature to the kernel.
  - No need any backtracking for new features.
- **Storage**
  - Easily Migrate to another persistent storage by implementing the `Storage` Interface
- **View**
  - Easily change the view layer by implementing the `View` interface.

# Features

- Add Category
- View Category
- Add Income
- View Income
- Add Expense
- View Expense
- Gracefully Shutdown 

Every input will go through a validation process.

# Usage
```bash
git clone https://github.com/OmarFaruk-0x01/expense-tracker

cd expense-tracker

chmod +x main.php
  
./main.php # Linux / MacOs / GitBash
  
php main.php # Windows and all other platform
```
