# PrescriptionBook
This is a wordpress plugin that allows physiotherapists to assign prescriptions to their patients. This was developed as a part of Capstone experience subject in Melbourne Polytechnic for the TeleHealth Web Monitor project.

Upon installing the plugin:
1. There will be two new user roles : Physiotherapist and Patient. Each will have different sets of capabilities that they can modify to the website.
2. There will be a new tab in the menu bar "Prescriptions", where physiotherapist will be able to add a new prescription and fill in the details.
    The details include Prescription title, Description, Select Patient and Select Videos.
    To prevent the access to the prescriptions by other users it is must to set the visibility to private.
    ![alt text](https://github.com/mroshan33/PrescriptionBook/blob/master/images/New%20Prescription%20View.jpg?raw=true)
    
    
 Once the prescription is saved, it is then displayed to the patient via a different standalone app using REST API. Check out my repo "THPatient" which is a standalone app with authentication feature and displays the prescriptions of the logged in patient.
    ![alt text](https://github.com/mroshan33/PrescriptionBook/blob/master/images/Prescription%20List%20View%20in%20the%20standalone%20application.jpg?raw=true)
