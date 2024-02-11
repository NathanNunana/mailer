const express = require("express");
const nodemailer = require("nodemailer");
const ejs = require("ejs");
const path = require("path");
require("dotenv").config();

const app = express();

const port = process.env.PORT || 3000;

app.use(express.urlencoded({ extended: true }));

app.set("view engine", "ejs");

app.set("views", path.join(__dirname, "views")); 

app.use(express.static('public'));

app.get("/", (req, res) => {
  res.render("index", { error: null });
});

app.post("/send-email", async (req, res) => {
  const { to, subject, message } = req.body;

  try {
    const transporter = nodemailer.createTransport({
      service: 'gmail',
      auth: {
        user: process.env.MAIL,
        pass: process.env.PASSWORD,
      }
    });

    const htmlTemplate = await ejs.renderFile(path.join(__dirname, "views", "email_template.ejs"), {
      to,
      subject,
      message
    });

    const mailOptions = {
      from: process.env.MAIL,
      to,
      subject,
      html: htmlTemplate
    };

    await transporter.sendMail(mailOptions);
    console.log('Email sent successfully');
    res.redirect('/');
  } catch (error) {
    console.error('Error sending email:', error.message);
    res.render("index", { error: 'Error sending email. Please try again.' });
  }
});

app.listen(port, () => {
  console.log("Server running on port", port);
});
