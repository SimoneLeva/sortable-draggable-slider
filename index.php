<html>

<head>
  <title>Swiper | Drag & Drop</title>
  <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
</head>

<body>
  <style>

    h1 {
      text-align: center;
    }

    #div {
      width: 100%;
      height: 100%;
      display: grid;
      align-items: center;
    }

    .slider-container {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 8px;
      width: 80%;
      margin: 0 auto;
    }

    .slider-item {
      width: 180px;
      height: 320px;
      cursor: grab;
      display: grid;
      align-items: center;
    }

    .slider-item h2 {
      text-align: center;
    }

    .slider-item:nth-child(1){
      background-color: lightgrey;
    }

    .slider-item:nth-child(2){
      background-color: lightskyblue;
    }

    .slider-item:nth-child(3){
      background-color: lightgreen;
    }

    .slider-item:nth-child(4){
      background-color: lightpink;
    }

    .slider-item:nth-child(5){
      background-color: lightgoldenrodyellow;
    }
  </style>

  <div id="div"></div>

  <script type="text/babel">
    const { useState } = React;

    function CustomSlider() {
      /* @ToDo: forEach Slide SetState ID */
      const [slides, setSlides] = useState([
        { id: 1 },
        { id: 2 },
        { id: 3 },
        { id: 4 },
        { id: 5 }
      ]);

      const handleDragStart = (e, index) => {
        e.dataTransfer.setData("text/plain", index.toString());
      };

      const handleDragOver = (e) => {
        e.preventDefault();
      };

      const handleDrop = (e, dropIndex) => {
        const dragIndex = parseInt(e.dataTransfer.getData("text/plain"));
        const updatedSlides = [...slides];
        const [draggedSlide] = updatedSlides.splice(dragIndex, 1);
        updatedSlides.splice(dropIndex, 0, draggedSlide);
        setSlides(updatedSlides);
      };

      const handleDragEnd = (e) => {
        e.preventDefault();
      };

      return (
        <div className="App">
          <h1>Sortable Slider with the Drag&Drop</h1>
          <div className="slider-container">
            {slides.map((slide, index) => (
              <div
                key={slide.id}
                className="slider-item"
                draggable
                onDragStart={(e) => handleDragStart(e, index)}
                onDragOver={handleDragOver}
                onDrop={(e) => handleDrop(e, index)}
                onDragEnd={handleDragEnd}
              >
                <h2>{slide.id}</h2> 
              </div>
            ))}
          </div>
        </div>
      );
    }

    const container = document.getElementById('div');
    const root = ReactDOM.createRoot(container);
    root.render(<CustomSlider />)
  </script>
</body>

</html>