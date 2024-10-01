# CRM for Study Abroad Consultancy

A CRM system designed for study abroad consultancy firms to manage student applications, visa processes, consultants, and financial data.

## Table of Contents
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Usage](#usage)
- [Database Structure](#database-structure)
- [Environment Variables](#environment-variables)
- [Deployment](#deployment)
- [Contributing](#contributing)
- [License](#license)

## Features
- **User Roles & Permissions**: Admin, Consultant, Visa Specialist, Finance Officer, etc.
- **Student Management**: Manage student profiles, documents, and applications.
- **Application Tracking**: Keep track of student applications and their statuses.
- **Visa Processing**: Monitor visa applications, documents, and statuses.
- **Financial Management**: Manage student payments and generate invoices.
- **Notifications**: Send automated email and SMS notifications.
- **Reports**: Generate reports on students, consultants, applications, and finances.
- **University and Course Management**: University Database, Course Information, Application Deadline Alerts.

## Tech Stack
- **Backend**: Laravel 10
- **Frontend**: Vue.js 3 with Vuetify (for UI components)
- **Database**: MySQL 8.0
- **Deployment**: Docker (for containerization), Nginx, CI/CD with DevOps pipeline
- **Version Control**: Git & GitHub

## Installation

### Prerequisites
- **Docker**: To containerize the application.
- **PHP**: Version 8.1 or higher.
- **Node.js**: For Vue.js frontend.
- **MySQL**: Version 8.0 or higher.
- **Composer**: For managing PHP dependencies.

## Usage

Once the project is set up and running, you can start using the CRM for study abroad consultancy as follows:

### 1. Logging In

- Navigate to `http://localhost:8080` to access the login page.
- Use the credentials provided during the seeding process to log in as an Admin, Consultant, or any other user role.
  
### 2. Managing Students

- Once logged in, go to the **Students** section from the dashboard.
- Here, you can:
  - View the list of students.
  - Add new student profiles, including personal details, educational background, and documents.
  - Edit or delete existing student profiles.

### 3. Tracking Applications

- Head to the **Applications** section to view the status of all student applications.
- You can filter applications by their current status (e.g., In Review, Accepted, Rejected).
- Use the action buttons to view or update application details, upload documents, or communicate with students.

### 4. Visa Processing

- In the **Visa Management** section, monitor visa applications for students.
- You can:
  - View visa application details, including submission dates and current status.
  - Update visa statuses (e.g., Approved, Rejected).
  - Send notifications to students regarding their visa status.

### 5. Financial Management

- Go to the **Finance** or **Invoicing** section to view and manage student payments.
- The system allows you to:
  - Generate invoices for student services.
  - Track payment status (Paid, Pending).
  - Issue payment reminders via email or SMS.

### 6. User Roles & Permissions

- The system supports various user roles (Admin, Consultant, Visa Specialist, Finance Officer).
- Admin users can manage user roles and assign different permissions from the **User Management** section.

### 7. Generating Reports

- From the **Reports** section, admins can generate detailed reports on students, applications, visa statuses, and finances.
- Reports can be filtered by date range, student nationality, university, and other factors.

### 8. Notifications

- Automatic notifications (email/SMS) are sent for key events such as:
  - New application submission.
  - Visa status updates.
  - Payment reminders.
  
These notifications help keep both the consultants and students informed.

### 9. Dashboard Overview

- The dashboard provides an overview of the system’s key metrics:
  - Total Students.
  - Total Applications.
  - Pending Visas.
  - Unpaid Invoices.
  
Admins and consultants can use this summary to keep track of progress and identify any areas needing attention.

### 10. Advanced Search & Filters

- The system includes advanced search and filtering options to quickly find students, applications, or invoices based on specific criteria (e.g., name, email, nationality, application status).


## Database Structure

The CRM system is built using a relational database, structured in a way that supports the management of students, applications, visa processing, and invoicing. Below is an overview of the key database tables and their relationships.

### 1. **Students Table**
- Stores student personal information.
- **Fields**:
  - `id` (Primary Key)
  - `name`
  - `email`
  - `phone`
  - `nationality`
  - `date_of_birth`
  - `created_at`, `updated_at`
  
### 2. **Applications Table**
- Contains records of students' applications to universities or courses.
- **Fields**:
  - `id` (Primary Key)
  - `student_id` (Foreign Key referencing `students.id`)
  - `course_name`
  - `university_name`
  - `application_status` (e.g., In Review, Accepted, Rejected)
  - `submitted_at`
  - `created_at`, `updated_at`
  
### 3. **Visa Applications Table**
- Tracks the visa application process for students.
- **Fields**:
  - `id` (Primary Key)
  - `student_id` (Foreign Key referencing `students.id`)
  - `visa_status` (e.g., Pending, Approved, Rejected)
  - `visa_submission_date`
  - `created_at`, `updated_at`
  
### 4. **Invoices Table**
- Manages student payments for consultancy services.
- **Fields**:
  - `id` (Primary Key)
  - `student_id` (Foreign Key referencing `students.id`)
  - `amount`
  - `payment_status` (e.g., Paid, Pending)
  - `due_date`
  - `created_at`, `updated_at`

### 5. **Users Table**
- Stores user information for different roles within the system (e.g., Admin, Consultant, Visa Specialist).
- **Fields**:
  - `id` (Primary Key)
  - `name`
  - `email`
  - `password`
  - `role` (e.g., Admin, Consultant)
  - `created_at`, `updated_at`

### 6. **Roles & Permissions**
- Role-based access control (RBAC) is implemented to define what actions each user role can perform.
- **Tables**:
  - `roles`: Stores user roles (e.g., Admin, Consultant, Finance Officer).
  - `permissions`: Defines specific permissions for each role.
  - `role_user`: Pivot table linking users to roles.

### 7. **Notifications Table**
- Stores notifications sent to students or staff members.
- **Fields**:
  - `id` (Primary Key)
  - `recipient_id` (Foreign Key referencing either a user or student)
  - `message`
  - `status` (Sent, Pending)
  - `created_at`, `updated_at`

### Relationships
- **One-to-Many**:
  - A student can have multiple applications, visa applications, and invoices.
  - A user (consultant/admin) can manage multiple students.
  
- **Many-to-Many**:
  - Users can have multiple roles (through `role_user` table).
  
- **Foreign Key Constraints**:
  - Foreign keys ensure data consistency between tables, such as `student_id` linking students to their applications, invoices, and visa applications.
  
### ER Diagram
An Entity-Relationship (ER) diagram provides a visual representation of the database schema and relationships. (You can include the actual ER diagram here as an image or a link to the diagram.)

## Environment Variables

To run this project, you will need to set up the following environment variables. These are typically defined in a `.env` file in the root directory of your Laravel project.

### Laravel Backend Environment Variables
- `APP_NAME`: The name of your application (e.g., "CRM System").
- `APP_ENV`: The environment in which your application is running (`local`, `production`, etc.).
- `APP_KEY`: The encryption key, generated using `php artisan key:generate`.
- `APP_DEBUG`: Set to `true` or `false` to enable/disable debug mode.
- `APP_URL`: The base URL for your application (e.g., `http://localhost`).

### Database Configuration
- `DB_CONNECTION`: The database driver (e.g., `mysql`).
- `DB_HOST`: The database host (e.g., `127.0.0.1`).
- `DB_PORT`: The port on which the database is running (e.g., `3306` for MySQL).
- `DB_DATABASE`: The name of the database.
- `DB_USERNAME`: The database username.
- `DB_PASSWORD`: The database password.

### Mail Configuration
- `MAIL_MAILER`: The mail driver (e.g., `smtp`).
- `MAIL_HOST`: The SMTP host for email services.
- `MAIL_PORT`: The port for SMTP.
- `MAIL_USERNAME`: The email username.
- `MAIL_PASSWORD`: The email password.
- `MAIL_ENCRYPTION`: Encryption method for emails (`tls` or `ssl`).
- `MAIL_FROM_ADDRESS`: The "from" address for outgoing emails.
- `MAIL_FROM_NAME`: The "from" name for outgoing emails.

### API Keys and External Services
- `STRIPE_KEY`: API key for Stripe payment integration (if used).
- `STRIPE_SECRET`: Secret key for Stripe payments.
- `AWS_ACCESS_KEY_ID`: AWS access key for using Amazon Web Services (if used).
- `AWS_SECRET_ACCESS_KEY`: AWS secret key.
- `AWS_DEFAULT_REGION`: AWS region (e.g., `us-east-1`).

### Other Services (Optional)
- `PUSHER_APP_ID`: Pusher App ID for real-time notifications.
- `PUSHER_APP_KEY`: Pusher App Key.
- `PUSHER_APP_SECRET`: Pusher App Secret.
- `PUSHER_APP_CLUSTER`: Pusher cluster region.

### Example `.env` File:
```bash
APP_NAME=CRMSystem
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm_database
DB_USERNAME=root
DB_PASSWORD=secret

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=example@crm.com
MAIL_FROM_NAME="${APP_NAME}"

STRIPE_KEY=your-stripe-key
STRIPE_SECRET=your-stripe-secret


