class Card {
    constructor(type, slots) {
      this.type = type;
      this.slots = slots;
    }

    cardInfo(){
        return `type: ${this.type} slots:${this.slots}`;
    }
  }

  function createBerryCard(){
      
  }

  const foodCard = new Card("food", 0);
  console.log(foodCard.cardInfo());