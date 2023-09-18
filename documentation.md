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

