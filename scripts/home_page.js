const testimonials = [
    {
      quote: "OMG! This recipe website is lit! It has all the trendy recipes that are on fleek. My friends and I love trying out the latest food trends from this site. It's a vibe!",
      author: "- Sarah Johnson"
    },
    {
      quote: "Yasss! Finally, a recipe website that speaks my language. The step-by-step instructions are so easy to follow, even for a kitchen newbie like me. I've been able to impress my friends with my cooking skills!",
      author: "- David Smith"
    },
    {
      quote: "This recipe website is goals! I can find recipes for all my dietary preferences like vegan, gluten-free, and keto. The food pics are so aesthetic, it's like they were made for the gram!",
      author: "- Emily Davis"
    },
    {
      quote: "Wow! This Website is a game-changer. It's now my go-to Website for dinner parties.",
      author: "- Michael Thompson"
    },
    {
      quote: "I'm not usually a fan of cooking, but Mesob Magic made it so easy and enjoyable. Thanks a lot!",
      author: "- Jessica Brown"
    },
    {
      quote: "I'm not saying this recipe website is my soulmate, but it understands my deepest snack cravings. From cheesy nachos to indulgent desserts, it's got my taste buds screaming yas queen! Let's snack and slay, fam!",
      author: "- Christopher Wilson"
    }
  ];

  // Function to dynamically generate testimonial cards
  function generateTestimonialCard(quote, author) {
    const testimonialCard = document.createElement('div');
    testimonialCard.classList.add('testimonial-card');

    testimonialCard.innerHTML = `
      <div class="quote">
        "${quote}"
      </div>
      <div class="author">
        ${author}
      </div>
    `;

    return testimonialCard;
  }

  // Generate testimonial cards dynamically
  const testimonialContainer = document.getElementById('testimonial-container');

  testimonials.forEach(testimonial => {
    const testimonialCard = generateTestimonialCard(testimonial.quote, testimonial.author);
    testimonialContainer.appendChild(testimonialCard);
  });
  const cuisines = [
    {
      image: 'https://st.depositphotos.com/1328914/3359/i/950/depositphotos_33590291-stock-photo-mexican-food.jpg',
      name: 'Mexican'
    },
    {
      image: 'https://c8.alamy.com/comp/HXWP33/italian-food-spaghetti-al-tonno-tuna-fish-with-fresh-tomatoes-HXWP33.jpg',
      name: 'Italian'
    },
    {
      image: 'https://img.grouponcdn.com/iam/3xvYpEYRPCUdJsCGTv2JGtUg5LMg/3x-2048x1229/v1/t600x362.jpg',
      name: 'Chinese'
    },
    {
      image: 'https://c.ndtvimg.com/2020-01/3ptkv9qo_egg-paratha_625x300_23_January_20.jpg',
      name: 'Indian'
    },
    {
      image: 'https://media-cdn.tripadvisor.com/media/photo-m/1280/1c/5d/d3/0b/200g.jpg',
      name: 'American'
    },
    {
      image: 'https://insanelygoodrecipes.com/wp-content/uploads/2021/07/Homemade-Ethiopian-Doro-Wat-Chicken-And-Egg-with-Spicy-Sauce.jpg',
      name: 'Ethiopian'
    }
  ];

  // Function to dynamically generate cuisine cards
  function generateCuisineCard(image, name) {
    const cuisineCard = document.createElement('div');
    cuisineCard.classList.add('home_browse_card_cuisne');

    cuisineCard.innerHTML = `
      <img src="${image}">
      <p><a href="search.php?input=${name}&function=cusine">${name}</a></p>
      
    `;

    return cuisineCard;
  }

  // Generate cuisine cards dynamically
  const cuisineContainer = document.getElementById('cuisine-container');

  cuisines.forEach(cuisine => {
    const cuisineCard = generateCuisineCard(cuisine.image, cuisine.name);
    cuisineContainer.appendChild(cuisineCard);
  });

  document.getElementById("home_contact-us").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting normally
  
    var formData = new FormData();
    var feedback = document.getElementById("home_contact-us_message").value;
    var email = document.getElementById("home_contact-us_email").value;
  
    formData.append("email", email);
    formData.append("feedback", feedback);
  
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/feedback.php", true);
  
    xhr.onload = function() {
      if (xhr.status === 200) {
        console.log(xhr.response);
        console.log("Feedback submitted successfully!");
        // Perform any desired actions, e.g., display a success message
        alert("Feedback submitted successfully!");
        location.reload();
      } else {
        console.log("Failed to submit feedback.");
        // Handle the error case, e.g., display an error message
      }
    };
  
    xhr.onerror = function() {
      console.log("An error occurred during the request.");
      // Handle any network or server errors
    };
  
    xhr.send(formData);
  });
  