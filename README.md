GrandMail
=========

Convert emails to pieces of dead trees carried by the postal service to your elderly/luddite friends and family!!!

This uses SendGrid to turn emails into a post request, where we compare the email it's coming from, and the name it's going to to find the correct addres within our database, allowing for very easy interaction.
For instance, if I email debolt@grandmail.bymail.in, our database will give my address as a return address, and Jake Debolts address as the to address. I could set up as many such aliases as needed.
Also, multiple people could use the same name, but go to different places. The from email is part of the query.

In the future, we would like to implement an actual user system, with better management, as the current system was designed quickly due to time constraints.

We also would like to work on templates, which would not be hard to implement. We have the subject line as a completely extraneous way to pass extra information along, and it would be relatively simple to get templates working.

http://mfurland.w3.uvm.edu/GrandMail/