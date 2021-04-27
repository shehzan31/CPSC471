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
![image](https://user-images.githubusercontent.com/47336141/116320398-c9017a80-a77d-11eb-8c59-88a151fee0db.png)

Once you press login, you are brought into the login page, which looks like
![image](https://user-images.githubusercontent.com/47336141/116320446-df0f3b00-a77d-11eb-92e2-05294d02bb2d.png)

From here, you can put your username or password, depending on if you are a doctor or a
patient and be directed towards your specific dashboard.
If you log in as a patient, in this case the patient is “Jane Doe”( username: 201201201,
password: Password1) you will initially see a dashboard with all your health diagnosis and
dependents like this:
![image](https://user-images.githubusercontent.com/47336141/116320472-e898a300-a77d-11eb-9331-e84e227dd342.png)

You can log out at any time by pressing the “logout” button and be moved to the index page
again. You can also browse through your appointments, prescriptions and tests by clicking the
tabs on the left, each will show the following respectively:
![image](https://user-images.githubusercontent.com/47336141/116320506-f51cfb80-a77d-11eb-87e0-5845e1436849.png)
![image](https://user-images.githubusercontent.com/47336141/116320534-00702700-a77e-11eb-80e9-2f2b8fe7b9ec.png)
![image](https://user-images.githubusercontent.com/47336141/116320548-09f98f00-a77e-11eb-9ddb-ec04c73297e7.png)

If you logged in as a doctor (sample: username: 123456789, password: password), you will see
the doctor dashboard where you will be able to look at patient information using a search bar.
![image](https://user-images.githubusercontent.com/47336141/116320569-154cba80-a77e-11eb-8fbf-1a769a3825b9.png)

To check a patient's health information, you can search their Health number using the search
bar, in this case i will search up Jane Doe (hnum: 201201201), giving us the following:
![image](https://user-images.githubusercontent.com/47336141/116320597-24cc0380-a77e-11eb-9aa5-486d27b747e9.png)

Here we see all of the patients information, and with the buttons on the right you can post new
appointments, conditions, prescriptions and tests for the patients as showing in the following:
![image](https://user-images.githubusercontent.com/47336141/116320611-2d243e80-a77e-11eb-83f3-9d94a8585239.png)
![image](https://user-images.githubusercontent.com/47336141/116320645-39a89700-a77e-11eb-94c6-e0b122d2c8ff.png)
![image](https://user-images.githubusercontent.com/47336141/116320668-40cfa500-a77e-11eb-9624-fe484e025ed4.png)
![image](https://user-images.githubusercontent.com/47336141/116320689-4af1a380-a77e-11eb-96b3-2fb70cd10bc4.png)

You can post new information by putting the appropriate data on the text field on the bottom of
each pop up, and clicking the “Submit” button once you are done. You should be able to refresh
the tab and see the data being posted. After this the doctor can log out and be sent back to the
index page.
