create database EVBikeRental
go

use EVBikeRental
go

Create table [Users](
	UserID Uniqueidentifier,
	FullName nvarchar(50),
	PhoneNumber nvarchar(20),
	[Image] Nvarchar(256),
	IdLic Nvarchar(256),
	[Address] Nvarchar(128),
	Gender varchar(10),
	primary key (UserID)
)

Create table Stations(
	StationID nvarchar(20),
	StationName nvarchar(50),
	[Address] nvarchar(128),
	Longitude nvarchar(30),
	Latitude nvarchar(30),
	primary key (StationID)
)

Create table Vehicle(
	VehicleID nvarchar(15),
	VehicleName nvarchar(30),
	[Type] varchar(10),
	Color varchar(10),
	[Status] varchar(10),
	BatteryLevel nvarchar(10),
	primary key (VehicleID),
)

Create table VehicleStation(
	StationID nvarchar(20),
	VehicleID nvarchar(15),
	primary key (StationID, VehicleID),
	foreign key (StationID) references Stations(StationID),
	foreign key (VehicleID) references Vehicle(VehicleID)
)

Create table Contract(
	Id int identity(1,1),
	VehicleID nvarchar(15),
	UserID Uniqueidentifier,
	StationIdRev nvarchar(20),
	StationIdRef nvarchar(20),
	RentStart Datetime,
	RentEnd Datetime
	primary key (Id, VehicleID, UserID, StationIdRev, StationIdRef),
	foreign key (VehicleID) references Vehicle(VehicleID),
	foreign key (UserID) references Users(UserID),
	foreign key (StationIdRev) references Stations(StationID),
	foreign key (StationIdRef) references Stations(StationID)
)
go

create procedure Insert_Users
	@FullName nvarchar(50),
	@PhoneNumber nvarchar(20),
	@Image Nvarchar(256),
	@IdLic Nvarchar(256),
	@Address Nvarchar(128),
	@Gender varchar(10)
as
begin
	Insert into Users(UserID, FullName, PhoneNumber, Image, IdLic, Address, Gender) 
	values (NEWID(),@FullName,@PhoneNumber, @Image, @IdLic, @Address, @Gender)
end

Exec Insert_Users  N'Nguy?n Van An', N'0905123456',  N'/images/userA.png',  N'CMND123456789',  N'Hà N?i',  'Male';
Exec Insert_Users  N'Nguy?n Hoàng Anh', N'090142341',  N'/images/hoanganh.png',  N'CMND123455741',  N'Hà N?i',  'Male';
Exec Insert_Users  N'Nguy?n Quang Minh', N'090158412',  N'/images/minh.png',  N'CMND546355742',  N'Hà N?i',  'Male';
go

create procedure Insert_Stations
	@StationID nvarchar(20),
	@StationName nvarchar(50),
	@Address nvarchar(128),
	@Longitude nvarchar(30),
	@Latitude nvarchar(30)
as
begin
	Insert into Stations(StationID, StationName, Address, Longitude, Latitude) 
	values (@StationID,@StationName,@Address, @Longitude, @Latitude)
end

Exec Insert_Stations N'CG1', N'Tr?m C?u Gi?y 1', N'S? 25 C?u Gi?y', N'105.666565', N'95.666565';
Exec Insert_Stations N'CG2', N'Tr?m C?u Gi?y 2', N'S? 2 C?u Gi?y', N'106.666565', N'96.666565';
Exec Insert_Stations N'XD1', N'Tr?m Xuân Ð?nh 1', N'S? 1 Xuân Ð?nh', N'201.666565', N'56.666565';
Exec Insert_Stations N'MD1', N'Tr?m Mai D?ch 1', N'S? 15 Mai D?ch', N'156.666565', N'15.666565';
go

Create procedure Insert_Vehicle
	@VehicleID nvarchar(15),
	@VehicleName nvarchar(30),
	@Type varchar(10),
	@Color varchar(10),
	@Status varchar(10),
	@BatteryLevel nvarchar(10)
as
Begin
	Insert into Vehicle(VehicleID, VehicleName, Type, Color, Status, BatteryLevel) 
	values (@VehicleID, @VehicleName, @Type, @Color, @Status, @BatteryLevel)
end

Exec Insert_Vehicle N'29B-1.25654', N'VinFast Evo200', N'VF', N'Màu xanh', N'S?n sàng', '90%';
Exec Insert_Vehicle N'29B-1.25655', N'VinFast Evo200', N'VF', N'Màu d?', N'Ðang s?c', '40%';
Exec Insert_Vehicle N'29B-2.25651', N'VinFast Evo201', N'VF', N'Màu vàng', N'S?n sàng', '95%';
Exec Insert_Vehicle N'29B-2.25652', N'VinFast Evo202', N'VF', N'Màu tr?ng', N'Ðang cho thuê', '70%';
go

Create procedure Insert_VehicleStation
	@StationID nvarchar(20),
	@VehicleID nvarchar(15)
as
Begin
	Insert into VehicleStation(StationID, VehicleID)
	Values (@StationID, @VehicleID)
end

Exec Insert_VehicleStation N'CG1', N'29B-1.25654';
Exec Insert_VehicleStation N'CG2', N'29B-1.25655';
Exec Insert_VehicleStation N'XD1', N'29B-2.25651';
Exec Insert_VehicleStation N'MD1', N'29B-2.25652';
go

Create PROCEDURE Insert_Contract
    @Id INT OUTPUT,
    @VehicleID NVARCHAR(15),
    @UserID UNIQUEIDENTIFIER,     
    @StationIdRev NVARCHAR(20),
    @StationIdRef NVARCHAR(20),
    @RentStart DATETIME,
    @RentEnd DATETIME
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO Contract(VehicleID, UserID, StationIdRev, StationIdRef, RentStart, RentEnd)
    VALUES (@VehicleID, @UserID, @StationIdRev, @StationIdRef, @RentStart, @RentEnd);

    SET @Id = SCOPE_IDENTITY();
    SELECT @Id AS NewContractId;
END

DECLARE @NewId INT;

EXEC Insert_Contract 
    @Id = @NewId OUTPUT,
    @VehicleID = N'29B-1.25654',
    @UserID = '3f351835-ad98-48fc-9231-1d34e1cc9395',
    @StationIdRev = N'CG1',
    @StationIdRef = N'CG2',
    @RentStart = '2025-09-25 20:37:31',
    @RentEnd   = '2025-09-25 20:37:31';

SELECT * from Contract

ALTER PROCEDURE ThongKeLuotThueTheoXe
AS
BEGIN
    SET NOCOUNT ON;

    SELECT 
        VehicleID,
        UserID,
        COUNT(*) AS SoLuotThue
    FROM Contract
    GROUP BY VehicleID, UserID
    ORDER BY SoLuotThue DESC;
END

EXEC ThongKeLuotThueTheoXe;

CREATE PROCEDURE ThongKeLuotThueTheoNgay
AS
BEGIN
    SET NOCOUNT ON;

    SELECT 
        CAST(RentStart AS DATE) AS Ngay,
        COUNT(*) AS SoLuotThue
    FROM Contract
    GROUP BY CAST(RentStart AS DATE)
    ORDER BY Ngay;
END

EXEC ThongKeLuotThueTheoNgay;

CREATE PROCEDURE ThongKeLuotThueTrongKhoang
    @TuNgay DATETIME,
    @DenNgay DATETIME
AS
BEGIN
    SET NOCOUNT ON;

    SELECT 
        VehicleID,
        COUNT(*) AS SoLuotThue
    FROM Contract
    WHERE RentStart >= @TuNgay AND RentEnd <= @DenNgay
    GROUP BY VehicleID
    ORDER BY SoLuotThue DESC;
END

EXEC ThongKeLuotThueTrongKhoang 
    @TuNgay = '2025-09-01',
    @DenNgay = '2025-09-30';