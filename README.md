# Full Stack Test
WPoets Full Stack Developer Test

Hi WPoets!

Thank you for giving me the opportunity to demonstrate my skills through the interview test. I have completed and submitted the required materials for your review.

<h2>Task</h2>
<ul>
  <li>Create a CRUD functionality using PHP, MySQL.</li>
	<li>Fetch the data to display the section that matches the given design using HTML5, CSS3, jQuery, Bootstrap.</li>
</ul>

<h2>Design</h2>

<h5>In Web view</h5>
<ul>
  <li>Column 1 is tabs. Each tab is a seperate slider.</li>
	<li>Clicking on the tab will change the slider in Column 2.</li>
	<li>
		Column 2 is a slider connected with column 3.
		<ul>
			<li>Which means when the slide in column 2 changes, the image in column 3 will change with it.</li>
			<li>Controls are attached to column 2 only.</li>
		</ul>
	</li>
	<li>Image in column 3 is a 1:1 image.</li>
</ul>

<h5>In Mobile view</h5>
<ul>
  <li>Column 1 changes to accordion.</li>
  <li>Column 2 is a slider with images from column 3 as background images.</li>
</ul>

<strong>Note: Please refer to the files directory for design files, relevant icons/images and styleguide.</strong>

<h2>Technical questions</h2>

Note : Create new database and import data from adminrb/backup.sql and update the new connections details in adminrb/config.php

Please answer the following questions in a markdown file called <code>Answers to technical questions.md</code>
<ul>
  <li>How long did you spend on the coding test? What would you add to your solution if you had more time? If you didn't spend much time on the coding test then use this as an opportunity to explain what you would add.<br/>
  Ans : Its has taken around 22-24 hours taken to complete the task and added some features in it
	<ul>
		<li>Admin Section - Admin Login</li>
		<li>Tab Module - Tab ID, Name, Icon (SVG format), Order, Status, [added and updated by user is in backend] and Total Sliders (Dynamic Count)</li>
		<li>Slider Module - Slider ID, Heading, Subheading, Button Text, Button Link, Desktop Image, Mobile Image, Order By, Status, Ref Tab ID [added and updated by user is in backend]</li>
		<li>Front End - Eash headline slider can syn with its image </li>
	</ul>
  Need additional time to fix the issue in responisve.
  </li>
	<li>How would you track down a performance issue in production? Have you ever had to do this?<br/>
	Ans : Will use the google pagespeed to track down a performance in production site and some testing tools (for backend)</li>
	<li>Please describe yourself using JSON.<br/>Ans: <br/>
	
	{
  "basics": {
    "name": "Rajeshkumar Basani",
    "label": "",
    "picture": "https://shorturl.at/EszSP",
    "email": "raj358822@gmail.com",
    "phone": "+91-9890358822",
    "degree": "B.Com / DIT",
    "website": "https://www.linkedin.com/in/rajeshbasani/",
    "summary": "12 years experience in web development. Currently working in PHP, Wordpress, Javascript, Bootstrap. Founder and Lead Developer at Rajeshwari Infotech - A proprietary company (2011-2016) - Developed multiple Web sites and customized web based application.",
    "location": {
      "address": "A5, 404, Sunshine Hills, Pisoli, Undri",
      "postalCode": "411060",
      "city": "Pune",
      "countryCode": "IN",
      "region": "Maharashtra"
    },
    "profiles": [
      {
        "network": "LinkedIn",
        "username": "rajeshbasani",
        "url": "https://www.linkedin.com/in/rajeshbasani/"
      }
    ]
  },
  "previous working company": [
    {
      "company": "Nutshell Advertising Pvt Ltd",
      "position": "Senior Web Developer",
      "website": "https://nutshelladvertising.com/",
      "startDate": "2021-02-01",
      "endDate": "2024-07-31",
      "summary": "Developing and maintaining Websites using PHP, HTML, CSS, Javascript and WordPres. Providing customized themes for WordPress. Handling PSD to HMTL/WordPres for seamless visual experience. Payment gateway integrations in woo-commerce websites.",
      "highlights": [
        "Notable creative projects - madandco.in",
        "Notable e-commerce projects --  WordPress - sidsfarm.com, Shopify - balancebreens.com"
      ]
    }
  ],

  "education": [
    {
      "institution": "NIIT",
      "course": "Certificate in Information Technology"
    },
    {
        "institution": "DAV Velankar College of Commerce, Solapur",
        "course": "B.Com"
      }
  ],

  "skills": [
    {
      "name": "WordPress",
      "level": "",
      "keywords": [
        "PSD to Wordpress", "Use less plugins", "Optimise Website"
      ]
    },
    {
        "name": "Core PHP",
        "level": "",
        "keywords": [
          "Develope Web Application", "Optimise Website"
        ]
      }
  ],
  "languages": [
    {
      "language": "Telugu",
      "fluency": "Pre-intermediate"
    }, 
    {
        "language": "Marathi",
        "fluency": "Intermediate"
    }, 
    {
        "language": "Hindi",
        "fluency": "Intermediate"
    }
    , 
    {
        "language": "English",
        "fluency": "Intermediate"
    }
  ]
}

	</li>
</ul>