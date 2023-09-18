## Goal of the application

To bring together companies looking for workers and students looking for work. Companies can post work offers, students can browse those offers and apply for them. Companies can view all applicants and can select one student for each offer.

Additionally, we have admin users who serve as moderators for all other users.

## Types of users

As mentioned above, we have three types of users:
1. Companies
2. Students
3. Admins

### Companies

We store the following information for company profiles:

- Name
- Email
- Password (hash)
- Verification status (by admins)
- Number of employees
- Field of work
- Description of company
- Founding year
- Website
- Address
- Logo image

Companies have access to the following features:

- View their own profile
- Edit their own profile
- Creating a new work offer
- A *My Offers* section where they can view all of their created offers in summarized format
- Creating a new offer
- Viewing a specific offer in more detail
- Editing an offer
- Deleting (cancelling) and offer
- Viewing a list of student-applicants for a specific offer
- Viewing a specific student's profile in more detail
- Accepting one applicant for each offer - all others will be automatically rejected

### Students

We store the following information for student profiles:

- Name
- Email
- Password (hash)
- Verification status (by admins)
- GPA
- University name
- Major name
- Date of enrollment
- Number of acquired credits
- Work experiences (separate table)
- Certifications (pdf documents)

Students have access to the following features:

- View their own profile
- Edit their own profile
- An *Offers* section where they can see all available offers in summarized format
- Viewing a specific offer in more detail - on a separate page
- Viewing the owner-company profile of the specific offer
- Applying for a specific offer with the click of a button
- A *My applications* section where they can see all of their applications
- Viewing the status of each application they have - waiting, accepted, rejected
- Cancellation of applications with status: waiting or accepted

### Admins

Admins have no additional information stored apart from their name, email, and password hash. They can view a list of registration requests in the *User requests* section. They can either accept or reject each request. They also have a separate *Verified users* section which shows a list of all existing verified users.

### Students' work experiences

Students can add and remove work experience information to their profile. Each work experience contains the following information:

- Work position
- Start date
- End date
- Description

### Student certifications

Students can upload and remove their certifications as pdf documents. These certifications can then be downloaded by companies while viewing their profiles as applicants.

### Software features

Aside from these features, the application implements other functionalities behind the scenes:

User authorization: using *Gates* we only allow access to certain controllers and views depending on several factors:

- User types
- Owner of offer
- Able to apply for offer

Database tables:
- users
- students
- companies
- offers
- offer_student
- certifications
- experiences
- other default tables

One-to-many relationships:
- student has multiple experiences
- student has multiple certifications
- company has multiple offers

Many-to-many relationships:
- students apply to many offers
- offers can have multiple applicants

One-to-one relationships:
- user can be a student, company or admin
- because of this, we have one-to-one relationship: user-student, user-company

## Technical documentation

We have several controllers responsible for the core functionality:
- AdminController
- ApplicationController
- CertificationController
- CompanyController
- ExperienceController
- OfferController
- StudentController
- ProfileController - modified

In essence, there is a controller for each model. All controllers are responsible for CRUD functionalities for their models.

We have the following models:
- Certification
- Company
- Experience
- Offer
- Student
- User - modified

In the `AuthServiceProvider.php` we have the following gates for user authorization:
- is-student
- is-company
- is-admin
- offer-owner
- can-apply

The database has undergone the following migrations:
- create users table
- create password reset tokens table
- create failed jobs table
- create personal access tokens table 
- create students table
- create companies table
- create offers table
- create applications table
- add polymorphic users
- add company-offer relationship
- add logo image to companies
- add *verified* field to users
- create experiences table
- create certifications table
- set on-delete settings

We store in the *public* folder the images for the company logos and the documents for the students.

We have several views, layouts, and components in the `resources/views` folder for:
- admins
- applications
- authentication
- companies
- experiences
- offers
- profile
- students
- other small modifications to the default views

We have most of the routes in the `web.php` file. Some routes related to authentication are in the `auth.php` file.

The routes are:
- PUT        accept/{offerId}/{studentId}
- GET        applicants/{offerId}
- GET        applications
- GET        apply/{offerId}
- DELETE     cancel-application/{offerId}
- GET        companies/{companyId}
- POST       experience
- GET        experience-create
- PUT        experience/{experienceId}
- DELETE     experience/{experienceId}
- GET        offers
- POST       offers
- GET        offers/create
- GET        offers/filter
- GET        offers/{offer}
- PUT PATCH  offers/{offer}
- DELETE     offers/{offer}
- GET        offers/{offer}/edit
- GET        profile
- PATCH      profile
- DELETE     profile
- GET        register-as
- GET        register-company
- POST       register-company
- GET        register-student
- POST       register-student
- PUT        reject-user
- DELETE     remove-user/{userId}
- POST       reset-password
- GET        reset-password/{token}
- GET        show-profile/{user}
- GET        students/certification/{certification}
- GET        students/download/{certification}
- POST       students/upload
- GET        students/{student}
- PUT        update-application/{offerId}/{studentId}
- GET        user-requests
- GET        verified-users
- PUT        verify-user  verify-user › AdminController@verifyUser  

The database is PostgreSQL. For testing purposes we have created the file `issok-connection.session.sql` - for testing queries directily with the DB. The necessary variables for connecting with the DB are stored in `.env`.