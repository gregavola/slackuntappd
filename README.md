# slackuntappd - A Slackbot for Untappd

This library is a simple script that allow you to enter a webhook URL and return beer information through the Slack interface by using the <code>untappd</code> command<br />

<img src="http://f.cl.ly/items/2x0y3u3N260K0p2F1Q0Y/Screen%20Shot%202014-08-31%20at%2010.10.48%20AM.png" />

# Requirements
PHP 5+<br />
CURL<br />

# Getting Access to the Untappd API
1. Head over to https://untappd.com/api and request and API key. Requests may take up to 2-3 weeks for approval, but once you get approval, add your <code>client_id</code> and <code>client_secret</code> to the <code>beer.php</code> file on line 26 and 27

# Getting Started with Slack
1. Upload <code>untappdPHP.php</code> and <code>beer.php</code> to your webserver.

2. Log into your Slack Instance and click on the Title of the Slack Group and select Configure Integrations 
<img src="http://f.cl.ly/items/0V3l3b0Y363Z03292s16/open___ABC_News_Digital_Slack_and_New_Tab.png">

3. Scroll down to the bottom of the page, and click "Outgoing Webhooks" 
<img src="http://f.cl.ly/items/2W153w0l3l0b1g0J003L/Add_Service_Integrations___ABC_News_Digital_Slack.png">

4. Add all the details in to the form, including the URL to the endpoint you uploaded the files in the repo to 
<img src="http://f.cl.ly/items/3S2r0N0Y3f1C210u1X1q/Team_Integration___ABC_News_Digital_Slack.png" />

5. Go into the channel you assigned the webhook and enter "untappd BEERNAME" and you'll be on your way!

# To Do
Error Handling

# Getting Help
If you need help or have questions, please contact Greg Avola on Twitter at http://twitter.com/gregavola