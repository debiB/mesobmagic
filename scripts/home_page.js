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
      image: 'https://i2.wp.com/www.downshiftology.com/wp-content/uploads/2019/07/Falafel-7.jpg',
      name: 'Sushi'
    },
    {
      image: 'https://i2.wp.com/www.downshiftology.com/wp-content/uploads/2019/07/Falafel-7.jpg',
      name: 'Kimchi'
    },
    {
      image: 'https://i2.wp.com/www.downshiftology.com/wp-content/uploads/2019/07/Falafel-7.jpg',
      name: 'Shawarma'
    },
    {
      image: 'https://i2.wp.com/www.downshiftology.com/wp-content/uploads/2019/07/Falafel-7.jpg',
      name: 'Mac and Cheese'
    },
    {
      image: 'https://i2.wp.com/www.downshiftology.com/wp-content/uploads/2019/07/Falafel-7.jpg',
      name: 'Lasagna'
    },
    {
      image: 'https://i2.wp.com/www.downshiftology.com/wp-content/uploads/2019/07/Falafel-7.jpg',
      name: 'Tacos'
    }
  ];

  // Function to dynamically generate cuisine cards
  function generateCuisineCard(image, name) {
    const cuisineCard = document.createElement('div');
    cuisineCard.classList.add('home_browse_card_cuisne');

    cuisineCard.innerHTML = `
      <img src="${image}">
      <p>${name}</p>
    `;

    return cuisineCard;
  }

  // Generate cuisine cards dynamically
  const cuisineContainer = document.getElementById('cuisine-container');

  cuisines.forEach(cuisine => {
    const cuisineCard = generateCuisineCard(cuisine.image, cuisine.name);
    cuisineContainer.appendChild(cuisineCard);
  });