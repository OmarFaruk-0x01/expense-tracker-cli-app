# Income-Expense Tracker
**Assignment-2**

# Objectives
Create an Income-Expense Tracker initially run on CLI. Trying to follow OOP in this whole project and also design principals. Implement storage for persisting data.

# Core Parts
This three core parts should be open for extension and close for modification.
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

