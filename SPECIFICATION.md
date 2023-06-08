# SPECIFICATION FOR A WEBSITE

## Overview
Provide a general summary of the web project. Must include:

* The "problem" your web project is trying to fix.
* The target audience of your web project.
---
Delivery on-demand garbage collection allows the users to request disposal to fit their exact needs. Eliminating the worry of when the garbage truck comes or when there is an excess amount of garbage piled from, for example, construction.

As our project is just the website portion and not a full-fledged corporation we can set our target audience from small homes to big factories by adding the appropriate features such institions would need.

---
## Team

Provide a list of team members. If team members have different roles and/or tasks, then list the roles of each member too.

### Aziz Abbasov

### Maksim Gorozhanko

### Georg Karu
---
## Goals, Objectives and Phases

### Objective

What is YOUR (not users) objective? What is the website supposed to achieve?

---
Creating a website infrastructure to allow for the booking of garbage disposal by members of a "colleciton site" creating a dynamic, yet realistic, schedule for garbage collectors. 

---
### Goals

List goals that can be used to measure if your website has reached its objective. The goals should be "SMART":

* specific
* measurable
* assignable
* realistic
* time-related

---
- [ ] log-in/sign-up page
    - [ ] adding back-end to it
- [ ] the booking/calendar page
    - [ ] adding back-end to it
- [ ] database for sotring bookings
- [ ] booking a single delivery
- [ ] user created delivery schedules
- [ ] restrict the possible amount of bookings on a give day
- [ ] creating a "delivery site" with multiple users
---

### Phases

Same as YOUR COURSE (`ISC0008`) milestones.

Milestone 1:

Creating the templates of 2 main HTML pages: Home and Requests

Milestone 2:

Creating booking functionality with php

Milestone 3:

Implementing sign up and log in functionality using JS, Database and PHP
Implementing profile page with bookings
Adding all additional information pages

## Content Structure

### Site map

Provide a hierarchical structure of your website as a `tree` (can be an image):

```text

HOME
+--LOG IN
|    +--SIGN UP
+--CONTACTS
+--PRICING
+--PRIVACY
+--TERMS
REQUESTS
+--CHOOSE DATE
|    +--BOOK APOINTMENT FOR A CERTAIN DATE
PROFILE
+--LOG IN
|    +--SIGN UP
|    +--CHECK BOOKINGS
|    +--CHANGE PASSWORD

```

### Content Types

Describe what kind of data types each page contains:

* Informational pages: Home, Privacy, Terms
* Interactive pages: Requests, Profile, Contact
* Pricing page: Pricing (Service packages)
* Images: Garbage collection machinery, logos, banners
* User data: Username, password, email, contact information

Are these data types hierarchical? etc.



---

### Page Templates

Before the first milestone you should have "page templates", i.e., HTML pages that illustrate what info and data each page will contain. You can use mock content.

Make sure you include navigation menus, etc.

## Design

The page templates should come with CSS to give a good idea what the pages will look like when all components (`PHP`, `SQL` and `JavaScript`) are added.

## Functionality

How does your website work? What are the specific parts that each of your page require?

* What fields are required for sign-up?
* What happens if user leaves a comment?
* What are the user roles?
* What are performance requirements?

* Users can sign up with a username, password, email, and contact information.
* Registered users can log in to manage their garbage collection services.
* Registered users can submit service requests and view the status of their requests.
* Registered users can update their profile information and preferences.
* All users can contact the garbage collection service for support or inquiries.

## Browser Support

Specify which browsers are supported. As minimum, your website should support:

* Chrome/Chromium
* Firefox
* mobile browsers (Chrome, Firefox, Safari, etc)

## Hosting

https://enos.itcollege.ee/~mgoroz/ics0008_group_project/
