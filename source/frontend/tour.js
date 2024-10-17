function startTour() {
    var intro = introJs();
    intro.setOptions({
      steps: [
        // Home Page Tour Steps
        {
          element: document.querySelector("#myTopnav"),
          intro:
            "This is the top navigation bar. It provides quick access to different sections of the website.",
          position: "bottom",
        },
        {
          element: document.querySelector("#inventoryBtn"),
          intro:
            "The Inventory button is your main gateway. It contains forms for data input, details for viewing data entries, and reports for generating Excel outputs from saved data entries.",
          position: "bottom",
        },
        {
          element: document.querySelector("#viewBtn"),
          intro:
            "The View button allows you to quickly navigate and find inserted data entries in the database.",
          position: "bottom",
        },
        {
          element: document.querySelector("#reportBtn"),
          intro:
            "The Report button lets you generate Excel reports directly from the captured data entries.",
          position: "bottom",
        },
        {
          element: document.querySelector("#announce"), // Updated ID here
          intro:
            "Check the Announcements section for important updates about the website. It provides information on any parts of the website that may not be working properly or other important announcements.",
          position: "bottom",
        },
        {
          element: document.querySelector("#logoutBtn"),
          intro:
            "Finally, the Logout button allows you to securely close your account and exit the website.",
          position: "bottom",
        },
        // Add more steps as needed for the home page
      ],
      tooltipPosition: "auto",
      positionPrecedence: ["left", "right", "top", "bottom"],
    });
  
    intro.start();
  };