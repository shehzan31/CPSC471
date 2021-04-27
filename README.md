# Interface for Healthcare Database
First download the latest from git at this link. After you have downloaded the repo, unzip the file
to your desktop. Next download xampp, and follow the instructions to download and install, for
this project you only need to download and run the Apache web server. After xampp is
downloaded, click start on the Apache module and verify that it is running correctly. Next, take
the folder that you unzipped called CPSC471/ and place it under the xampp/htdocs folder. You
are now ready to run the website on your machine, open your browser of choice and navigate to
this link: localhost/CPSC471/Website/index.html

In the beginning the first page will be the index, where information about the website will be
shown and from where you can move forward to the login page.
![image](https://user-images.githubusercontent.com/47336141/116320119-48db1500-a77d-11eb-94bf-a713f2b8f875.png)


Once you press login, you are brought into the login page, which looks like
![image](https://user-images.githubusercontent.com/47336141/116320135-4ed0f600-a77d-11eb-9447-a1ce88835eb3.png)

From here, you can put your username or password, depending on if you are a doctor or a
patient and be directed towards your specific dashboard.
If you log in as a patient, in this case the patient is “Jane Doe”( username: 201201201,
password: Password1) you will initially see a dashboard with all your health diagnosis and
dependents like this:
![image](https://user-images.githubusercontent.com/47336141/116320160-57293100-a77d-11eb-99b4-d5899aab6a04.png)

You can log out at any time by pressing the “logout” button and be moved to the index page
again. You can also browse through your appointments, prescriptions and tests by clicking the
tabs on the left, each will show the following respectively:
![image](https://user-images.githubusercontent.com/47336141/116320179-60b29900-a77d-11eb-8386-5ea20b33727c.png)
![image](https://user-images.githubusercontent.com/47336141/116320193-64462000-a77d-11eb-9005-279eed46cdaf.png)
![image](https://user-images.githubusercontent.com/47336141/116320198-68723d80-a77d-11eb-8390-faac9e8214b3.png)

If you logged in as a doctor (sample: username: 123456789, password: password), you will see
the doctor dashboard where you will be able to look at patient information using a search bar.
![image](https://user-images.githubusercontent.com/47336141/116320221-745dff80-a77d-11eb-9cf3-309eb48602a7.png)

To check a patient's health information, you can search their Health number using the search
bar, in this case i will search up Jane Doe (hnum: 201201201), giving us the following:
![image](https://user-images.githubusercontent.com/47336141/116320244-7cb63a80-a77d-11eb-8dcb-807a99e1b51a.png)

Here we see all of the patients information, and with the buttons on the right you can post new
appointments, conditions, prescriptions and tests for the patients as showing in the following:
![image](https://user-images.githubusercontent.com/47336141/116320268-863fa280-a77d-11eb-9f8f-5cee24b2d0b8.png)
![image](https://user-images.githubusercontent.com/47336141/116320279-8a6bc000-a77d-11eb-8098-90a8fc460908.png)
![image](https://user-images.githubusercontent.com/47336141/116320283-8cce1a00-a77d-11eb-8e89-cb7f672e5c24.png)
![image](https://user-images.githubusercontent.com/47336141/116320292-90fa3780-a77d-11eb-9dde-e23f806167a8.png)

You can post new information by putting the appropriate data on the text field on the bottom of
each pop up, and clicking the “Submit” button once you are done. You should be able to refresh
the tab and see the data being posted. After this the doctor can log out and be sent back to the
index page.
