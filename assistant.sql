Use VisitAssistant
GO
CREATE TABLE person
        (
		PersonID		NVARCHAR(10)		PRIMARY KEY,
		Room_Number     NVARCHAR(20)    NOT NULL FOREIGN KEY(RoomNumber) REFERENCES room(RoomNumber),
		PersonName    NVARCHAR(20)	NOT NULL,
		IsHouseHolder  NVARCHAR(2) CHECK(IsHouseHolder in('是','否')) NOT NULL,
		PhoneNumber     NVARCHAR(11) NOT NULL,
		PhoneCarrier    NVARCHAR(5)    NOT NULL,
		)
		
CREATE TABLE residentialarea
        (
		RaName       NVARCHAR(20)		PRIMARY KEY,
		Province     NVARCHAR(5)     NOT NULL,
		City         NVARCHAR(5)     NOT NULL,
		District     NVARCHAR(5)     NOT NULL,
		Region       NVARCHAR(5)     NOT NULL,
		RaAddress    NVARCHAR(50)    NOT NULL,	
		)
		
CREATE TABLE buildingstructure
        (
		Residentialarea_Name  NVARCHAR(20) NOT NULL FOREIGN KEY(RaName) REFERENCES residentialarea(RaName) on delete cascade,
		BlockName      NVARCHAR(10)   NOT NULL,
		TotalRooms     INT              NOT NULL,
		TotalFloors    INT              NOT NULL,
		InitFloor      INT              NOT NULL,
		)
		
CREATE TABLE room
        (
		RoomNumber      NVARCHAR(20)      PRIMARY KEY,
		NumOfRoomMember INT         NOT NULL,
		IsIPTV          NVARCHAR(2) CHECK(IsIPTV in('是','否')),
		IsDxKuandai     NVARCHAR(2) CHECK(IsDxKuandai in('是','否')),
		Dxkuandai      NVARCHAR(5) CHECK(Dxkuandai in('光纤接入','铜线接入')),
		BandWidth      NVARCHAR(6),
		DataTrafficPerMonth  NVARCHAR(6),
		ExpirationTimeOfBandWidth DATE NOT NULL,
		MonthlyConsumption    NVARCHAR(6),
		Appdaodayonghu INT         NOT NULL,
		HouseHolder    NVARCHAR(20)  NOT NULL FOREIGN KEY(PersonName) REFERENCES person(PersonName) on delete cascade,
		HouseHolder_PhoneNumber    NVARCHAR(11)  NOT NULL FOREIGN KEY(PhoneNumber) REFERENCES person(PhoneNumber) on delete cascade,
		VisitIn3mon    NVARCHAR(4) CHECK(VisitIn3mon in('未拜访','已拜访')),
		VisitTimes     INT         NOT NULL
		)   
		